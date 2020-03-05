<?php

namespace Takdeniz\PhoneVerify\Controllers;

use App\Http\Controllers\Controller;
use Takdeniz\PhoneVerify\Contracts\MustVerifyPhoneContract;
use Takdeniz\PhoneVerify\Traits\VerifiesPhone;

/**
 * Class VerificationController
 *
 * @package App\Http\Controllers\Auth
 * @author  Tuncay Akdeniz <akdeniztuncay44@gmail.com>
 * @version 0.1
 * @since   0.1
 */
class VerificationController extends Controller
{

	use VerifiesPhone;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
//        $this->middleware('auth');
		$this->middleware('throttle:6,1')->only('verify', 'resend');
	}

	/**
	 * @param $phoneNumber
	 * @return MustVerifyPhoneContract
	 */
	protected function getUserByPhone($phoneNumber)
	{
		$class = config('verify.user_class');

		return $class::where([
			'phone_number' => $phoneNumber
		])->first();
	}

	protected function errorUnauthorized($message = '')
	{
		$this->response->errorUnauthorized($message);
	}

	/**
	 * @param        $user
	 * @param string $message
	 * @return \Dingo\Api\Http\Response
	 */
	protected function verified($user, $message = '')
	{
		return $this->response->noContent();
	}

	/**
	 * @param        $user
	 * @param string $message
	 * @return \Dingo\Api\Http\Response
	 */
	protected function sent($user, $message = '')
	{
		return $this->response->noContent();
	}

}
