<?php
namespace Takdeniz\PhoneVerify\Contracts;

/**
 * Interface DriverContract
 *
 * @package Takdeniz\PhoneVerify\Contracts
 * @author  Tuncay Akdeniz <akdeniztuncay44@gmail.com>
 * @version 0.1
 * @since   0.1
 */
interface VerifierDriverContract
{
	/**
	 * @param $code
	 * @param $verification
	 * @return boolean
	 */
	public function check($code, $verification);

}
