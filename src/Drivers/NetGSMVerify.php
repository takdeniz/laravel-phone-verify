<?php
namespace Takdeniz\PhoneVerify\Drivers;

use Takdeniz\PhoneVerify\Contracts\VerifierDriverContract;
use Takdeniz\PhoneVerify\Contracts\MustVerifyPhoneContract;
use Takdeniz\PhoneVerify\Exceptions\VerificationFailException;
use Takdeniz\PhoneVerify\Repositories\VerifyPhoneRepository;

/**
 * Class NetGSMVerify
 *
 * @package Takdeniz\PhoneVerify\Drivers
 * @author  Tuncay Akdeniz <akdeniztuncay44@gmail.com>
 * @version 0.1
 * @since   0.1
 */
class NetGSMVerify implements VerifierDriverContract
{
	/**
	 * @param MustVerifyPhoneContract $verifiable
	 * @return mixed
	 */
	public function buildVerifyRequest($verifiable)
	{
		$code = rand(0, 1000);

		return (new VerifyPhoneRepository())->createVerifyRequest(
			$verifiable->getPhoneForVerification(),
			$code,
			'netgsm'
		);
	}

	/**
	 * @param $code
	 * @param $verification
	 * @return bool
	 * @throws VerificationFailException
	 */
	public function check($code, $verification)
	{
		if ($verification->code == $code) {
			return true;
		}
		throw new VerificationFailException(\Lang::get('invalid.code'));
	}

}
