<?php
namespace Takdeniz\PhoneVerify\Traits;

use Takdeniz\PhoneVerify\Notifications\VerifyPhoneNotification;

/**
 * Trait MustVerifyPhone
 *
 * @package Takdeniz\PhoneVerify\Traits
 * @author  Tuncay Akdeniz <akdeniztuncay44@gmail.com>
 * @version 0.1
 * @since   0.1
 */
trait MustVerifyPhone
{
	/**
	 * Determine if the user has verified their phone number.
	 *
	 * @return bool
	 */
	public function hasVerifiedPhone()
	{
		return !is_null($this->phone_verified_at);
	}

	/**
	 * Mark the given user's email as verified.
	 *
	 * @return bool
	 */
	public function markPhoneAsVerified()
	{
		return $this->forceFill([
			'phone_verified_at' => $this->freshTimestamp(),
		])->save();
	}

	/**
	 * Send the sms verification notification.
	 *
	 * @return void
	 */
	public function sendPhoneVerificationNotification()
	{
		$this->notify(new VerifyPhoneNotification());
	}

	/**
	 * Get the phone number that should be used for verification.
	 *
	 * @return string
	 */
	public function getPhoneForVerification()
	{
		$field = config('verify.phone_number_field');

		return $this->{$field};
	}

	/**
	 * @return string
	 */
	public function routeNotificationForNetgsm()
	{
		if ($pattern = config('verify.driver_resolver.netgsm')) {
			return preg_replace($pattern, '', $this->getPhoneForVerification());
		}

		return $this->getPhoneForVerification();
	}

}
