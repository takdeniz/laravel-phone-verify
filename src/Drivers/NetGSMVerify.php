<?php
namespace Takdeniz\PhoneVerify\Drivers;

use Takdeniz\PhoneVerify\Contracts\VerifierDriverContract;
use Takdeniz\PhoneVerify\Exceptions\VerificationFailException;
use TarfinLabs\Netgsm\NetgsmChannel;

/**
 * Class NetGSMVerify
 *
 * @package Takdeniz\PhoneVerify\Drivers
 * @author  Tuncay Akdeniz <akdeniztuncay44@gmail.com>
 * @version 0.1
 * @since   0.1
 */
class NetGSMVerify extends BaseVerify implements VerifierDriverContract
{
	protected $channelKey = 'netgsm';

	public function channel()
	{
		return NetgsmChannel::class;
	}

	/**
	 * @param $code
	 * @param $verification
	 * @return bool
	 * @throws VerificationFailException
	 */
	public function check($code, $verification)
	{
		if ($verification->code === $code) {
			return true;
		}
		throw new VerificationFailException(\Lang::get('invalid.code'));
	}

}
