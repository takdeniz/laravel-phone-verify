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

	public function deactivateVerifications($phoneNumber)
	{
		return PhoneVerification::where([
			$this->numberField() => $phoneNumber,
		])->update(['active' => 0]);
	}

	/**
	 * @param $phoneNumber
	 * @param $code
	 * @return mixed
	 */
	public function createVerifyRequest($phoneNumber, $code, $channel = null)
	{
		$this->deactivateVerifications($phoneNumber);

		return PhoneVerification::create([
			$this->numberField() => $phoneNumber,
			'code'               => $code,
			'channel'            => $channel,
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
		])->orderBy('created_at', 'DESC')
			->where('active', 1)
			->first();
	}

}
