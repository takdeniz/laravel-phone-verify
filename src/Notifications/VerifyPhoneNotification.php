<?php
namespace Takdeniz\PhoneVerify\Notifications;

use Config;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Nexmo;
use Takdeniz\PhoneVerify\Contracts\MustVerifyPhoneContract;
use Takdeniz\PhoneVerify\Repositories\VerifyPhoneRepository;

/**
 * Class VerifyPhoneNotification
 *
 * @package App\Notifications
 * @author  Tuncay Akdeniz <akdeniztuncay44@gmail.com>
 * @version 0.1
 * @since   0.1
 */
class VerifyPhoneNotification extends Notification implements ShouldQueue
{
	use Queueable;

	protected $verifyRequestId;

	/**
	 * Get the notification's channels.
	 *
	 * @param mixed $notifiable
	 * @return array|string
	 */
	public function via($notifiable)
	{
		return [/*'nexmo',*/ 'database'];
	}

	/**
	 * @return mixed
	 */
	protected function getBrand()
	{
		return Config::get('app.name');
	}

	/**
	 * Get the array representation of the notification.
	 *
	 * @param MustVerifyPhoneContract $notifiable
	 * @return array
	 */
	public function toArray($notifiable)
	{
		$verification = Nexmo::verify()->start([
			'number' => $notifiable->getPhoneForVerification(),
			'brand'  => $this->getBrand(),
		]);
//		$this->verifyRequestId = $verification->getRequestId();
		(new VerifyPhoneRepository())->createVerifyRequest(
			$notifiable->getPhoneForVerification(),
			$verification->getRequestId()
		);

		return [
			'message' => 'Phone number verification message has been sent'
		];
	}
}
