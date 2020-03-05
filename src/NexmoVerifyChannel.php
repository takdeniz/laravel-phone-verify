<?php
namespace Takdeniz\PhoneVerify;

use Illuminate\Notifications\Notification;
use Nexmo;
use Takdeniz\PhoneVerify\Repositories\VerifyPhoneRepository;

/**
 * Class NexmoVerifyChannel
 *
 * @package Takdeniz\PhoneVerify
 * @author  Tuncay Akdeniz <akdeniztuncay44@gmail.com>
 * @version 0.1
 * @since   0.1
 */
class NexmoVerifyChannel
{

	/**
	 * @param              $notifiable
	 * @param Notification $notification
	 */
	public function send($notifiable, Notification $notification)
	{
		$message = $notification->toNexmoVerify($notifiable);

		if (!isset($message['number'])) {
			$message['number'] = $notifiable->getPhoneForVerification;
		}

		if (!isset($message['brand'])) {
			$message['brand'] = config('app.name');
		}

		$verification = Nexmo::verify()->start($message);

		(new VerifyPhoneRepository())->createVerifyRequest(
			$message['number'],
			$verification->getRequestId(),
			'nexmo_verify'
		);
	}
}
