<?php
namespace Takdeniz\PhoneVerify\Repositories;

use Takdeniz\PhoneVerify\Models\PhoneVerification;

/**
 * Class VerifyPhoneRepository
 *
 * @package Takdeniz\PhoneVerify\Repositories
 * @author  Tuncay Akdeniz <akdeniztuncay44@gmail.com>
 * @version 0.1
 * @since   0.1
 */
class VerifyPhoneRepository
{
	/**
	 * @return \Illuminate\Config\Repository|mixed
	 */
	protected function numberField()
	{
		return config('verify.phone_number_field');
	}

	/**
	 * @param $phoneNumber
	 * @param $requestId
	 * @return mixed
	 */
	public function createVerifyRequest($phoneNumber, $requestId)
	{
		return PhoneVerification::create([
			$this->numberField() => $phoneNumber,
			'request_id'         => $requestId
		]);
	}

	/**
	 * @param $phoneNumber
	 * @return PhoneVerification
	 */
	public function latestVerification($phoneNumber)
	{
		return PhoneVerification::where([
			$this->numberField() => $phoneNumber,
		])->orderBy('created_at', 'DESC')->first();
	}

}
