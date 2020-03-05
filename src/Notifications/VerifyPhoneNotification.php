<?php
namespace Takdeniz\PhoneVerify\Notifications;

use Config;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Takdeniz\PhoneVerify\Contracts\MustVerifyPhoneContract;
use Takdeniz\PhoneVerify\Drivers\NetGSMVerify;
use TarfinLabs\Netgsm\NetgsmChannel;
use TarfinLabs\Netgsm\Sms\NetgsmOtpMessage;

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

	/**
	 * @var
	 */
	protected $verifyRequestId;

	/**
	 * Get the notification's channels.
	 *
	 * @param mixed $notifiable
	 * @return array|string
	 */
	public function via($notifiable)
	{
//		return [NexmoVerifyChannel::class, NetGsmChannel::class];
		return [NetGsmChannel::class];
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
		return [
			'number' => $notifiable->getPhoneForVerification(),
			'brand'  => $this->getBrand(),
		];
	}

	/**
	 * @param MustVerifyPhoneContract $notifiable
	 * @return array
	 */
	public function toNexmoVerify($notifiable)
	{
		return [
			'number' => $notifiable->getPhoneForVerification(),
			'brand'  => $this->getBrand(),
		];
	}

	/**
	 * @param $notifiable
	 * @return NetgsmOtpMessage
	 */
	public function toNetgsm($notifiable)
	{
		$verification = (new NetGSMVerify())->buildVerifyRequest($notifiable);

		return new NetGsmOtpMessage("Your {$this->getBrand()} code {$verification->code}. Expire in 5 minutes");
	}
}
