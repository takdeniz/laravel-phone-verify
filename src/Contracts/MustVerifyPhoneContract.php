<?php
namespace Takdeniz\PhoneVerify\Contracts;

/**
 * Interface MustVerifyPhone
 *
 * @package Takdeniz\PhoneVerify\Contracts
 * @author  Tuncay Akdeniz <akdeniztuncay44@gmail.com>
 * @version 0.1
 * @since   0.1
 */
interface MustVerifyPhoneContract
{
	/**
	 * Determine if the user has verified their phone number.
	 *
	 * @return bool
	 */
	public function hasVerifiedPhone();

	/**
	 * Mark the given user's email as verified.
	 *
	 * @return bool
	 */
	public function markPhoneAsVerified();

	/**
	 * Send the sms verification notification.
	 *
	 * @return void
	 */
	public function sendPhoneVerificationNotification();

	/**
	 * Get the phone number that should be used for verification.
	 *
	 * @return string
	 */
	public function getPhoneForVerification();
}
