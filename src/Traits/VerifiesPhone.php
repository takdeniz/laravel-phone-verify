<?php
namespace Takdeniz\PhoneVerify\Traits;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Nexmo\Laravel\Facade\Nexmo;
use Takdeniz\PhoneVerify\Contracts\MustVerifyPhoneContract;
use Takdeniz\PhoneVerify\Events\PhoneVerified;
use Takdeniz\PhoneVerify\Repositories\VerifyPhoneRepository;

/**
 * Trait VerifiesPhone
 *
 * @package App\Traits
 * @author  Tuncay Akdeniz <akdeniztuncay44@gmail.com>
 * @version 0.1
 * @since   0.1
 */
trait VerifiesPhone
{

	/**
	 * Mark the authenticated user's email address as verified.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function verify(Request $request)
	{
		$request->validate([
			'phone_number' => ['required', 'string',], //TODO sync
			'code'         => ['required', 'string', 'max:6']
		]);

		/** @var MustVerifyPhoneContract $user */
		$user = $this->getUserByPhone($request->phone_number);
		if (!$user) {
			return $this->errorUnauthorized();
		}
		if (env('SMS_SECRET_VERIFY') && $request->code === env('SMS_SECRET_VERIFY')) {
			return $this->verified($user);
		}

		$latest = app(VerifyPhoneRepository::class)->latestVerification($request->phone_number);

		if (!$latest) {
			return $this->errorUnauthorized();
		}

		try {
			Nexmo::verify()->check(
				$latest->request_id,
				$request->code
			); // ea560957cbb346f4a663a0dabb809006

		} catch (\Nexmo\Client\Exception\Request $e) {
			return $this->errorUnauthorized('invalid_code');
		}

		if ($user->markPhoneAsVerified()) {
			event(new PhoneVerified($user));

			return $this->verified($user);
		}

		return $this->errorUnauthorized();
	}

	/**
	 * Resend the email verification notification.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\Response
	 */
	public function resend(Request $request)
	{
		$request->validate([
			'phone_number' => ['required', 'string',], //TODO sync
		]);

		$latest = app(VerifyPhoneRepository::class)->latestVerification($request->phone_number);
		if ($latest && Carbon::now()->diffInSeconds($latest->created_at) < \Config::get('verify.allow_resend_in', 300)) {
			return $this->errorUnauthorized('wait_for_resend');
		}

		/** @var MustVerifyPhoneContract $user */
		$user = $this->getUserByPhone($request->phone_number);
		if (!$user) {
			return $this->errorUnauthorized('user_not_found'); //no user
		}

		if ($user->hasVerifiedPhone()) {
			return $this->sent($user, 'already_verified'); //already verified
		}

		$user->sendPhoneVerificationNotification();

		return $this->sent($user);
	}
}
