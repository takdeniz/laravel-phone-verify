<?php
namespace Takdeniz\PhoneVerify\Drivers;

use Takdeniz\PhoneVerify\Contracts\MustVerifyPhoneContract;
use Takdeniz\PhoneVerify\Repositories\VerifyPhoneRepository;

/**
 * Class BaseVerify
 *
 * @package Takdeniz\PhoneVerify\Drivers
 * @author  Tuncay Akdeniz <akdeniztuncay44@gmail.com>
 * @version 0.1
 * @since   0.1
 */
abstract class BaseVerify
{
	protected $channelKey;

	/**
	 * @param MustVerifyPhoneContract $verifiable
	 * @param string                  $code
	 * @return mixed
	 */
	public function buildVerifyRequest($verifiable, $code = null)
	{
		$code = $code ?: rand(1000, 9999);

		return (new VerifyPhoneRepository())->createVerifyRequest(
			$verifiable->getPhoneForVerification(),
			$code,
			$this->channelKey
		);
	}
}
