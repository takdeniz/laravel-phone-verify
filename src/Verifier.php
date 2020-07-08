<?php
namespace Takdeniz\PhoneVerify;

use Exception;
use Illuminate\Config\Repository;
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
	 * @return Repository|mixed
	 * @throws Exception
	 */
	public static function getDriverClass(string $driverName = null)
	{
		$driverName = $driverName ?: config('verify.default');
		$class      = config('verify.drivers.' . $driverName);
		if (!$class) {
			throw new Exception('verification.driver.not_found');
		}

		return $class;
	}

	/**
	 * @param string|null $driverName
	 * @return VerifierDriverContract
	 * @throws Exception
	 */
	public static function getDriver(string $driverName = null): VerifierDriverContract
	{
		$class = static::getDriverClass($driverName);

		return new $class;
	}

	/**
	 * @param $phoneNumber
	 * @return string
	 */
	public static function driverResolver($phoneNumber)
	{
		$driverResolver = config('verify.driver_resolver');
		$selectedDriver = null;
		if ($driverResolver) {
			foreach ($driverResolver as $driver => $pattern) {
				if (preg_match($pattern, $phoneNumber) === 1) {
					$selectedDriver = $driver;
					break;
				}
			}
		}

		return $selectedDriver;
	}

	/**
	 * @param                   $code
	 * @param PhoneVerification $verification
	 * @return bool
	 * @throws Exception
	 */
	public static function check($code, PhoneVerification $verification)
	{
		$driver = static::driverResolver($verification->phone_number);
		$status = static::getDriver($driver)->check($code, $verification);
		if ($status) {
			$verification->active = false;
			$verification->save();
		}

		return $status;
	}

}
