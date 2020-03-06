<?php
namespace Takdeniz\PhoneVerify;

use Takdeniz\PhoneVerify\Contracts\VerifierDriverContract;
use Takdeniz\PhoneVerify\Models\PhoneVerification;

/**
 * Class Verifier
 *
 * @package Takdeniz\PhoneVerify
 * @author  Tuncay Akdeniz <akdeniztuncay44@gmail.com>
 * @version 0.1
 * @since   0.1
 */
class Verifier
{

	/**
	 * @param string|null $driverName
	 * @return \Illuminate\Config\Repository|mixed
	 * @throws \Exception
	 */
	public static function getDriverClass(string $driverName = null)
	{
		$driverName = $driverName ?: config('verify.default');
		$class      = config('verify.drivers.' . $driverName);
		if (!$class) {
			throw new \Exception('verification.driver.not_found');
		}

		return $class;
	}

	/**
	 * @param string|null $driverName
	 * @return VerifierDriverContract
	 * @throws \Exception
	 */
	public static function getDriver(string $driverName = null): VerifierDriverContract
	{
		$class = static::getDriverClass($driverName);

		return new $class;
	}

	/**
	 * @param                   $code
	 * @param PhoneVerification $verification
	 * @return bool
	 * @throws \Exception
	 */
	public static function check($code, PhoneVerification $verification)
	{
		$status = static::getDriver()->check($code, $verification);
		if ($status) {
			$verification->active = false;
			$verification->save();
		}

		return $status;
	}

}
