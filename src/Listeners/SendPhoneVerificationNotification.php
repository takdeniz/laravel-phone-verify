<?php
namespace Takdeniz\PhoneVerify\Listeners;

use Illuminate\Auth\Events\Registered;
use Takdeniz\PhoneVerify\Contracts\MustVerifyPhoneContract;

/**
 * Class SendPhoneVerificationNotification
 *
 * @package App\Listeners
 * @author  Tuncay Akdeniz <akdeniztuncay44@gmail.com>
 * @version 0.1
 * @since   0.1
 */
class SendPhoneVerificationNotification
{
	/**
	 * Handle the event.
	 *
	 * @param \Illuminate\Auth\Events\Registered $event
	 * @return void
	 */
	public function handle(Registered $event)
	{
		if ($event->user instanceof MustVerifyPhoneContract
			&& !$event->user->hasVerifiedPhone()
			&& config('verify.send_verify_sms',true)
		) {
			$event->user->sendPhoneVerificationNotification();
		}
	}
}
