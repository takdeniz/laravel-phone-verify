<?php
namespace Takdeniz\PhoneVerify\Drivers;

use Nexmo;
use Takdeniz\PhoneVerify\Contracts\VerifierDriverContract;
use Takdeniz\PhoneVerify\NexmoVerifyChannel;

/**
 * Class NexmoVerify
 *
 * @package Takdeniz\PhoneVerify\Drivers
 * @author  Tuncay Akdeniz <akdeniztuncay44@gmail.com>
 * @version 0.1
 * @since   0.1
 */
class NexmoVerify extends BaseVerify implements VerifierDriverContract
{
	protected $channelKey = 'nexmo_verify';

	public function channel()
	{
		return NexmoVerifyChannel::class;
	}

	/**
	 * @param $code
	 * @param $verification
	 * @return mixed
	 * @throws \Nexmo\Client\Exception\Request
	 */
	public function check($code, $verification)
	{
		return Nexmo::verify()->check(
			$verification->code,
			$code
		);
	}

}
