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
	 * @return string
	 */
	public function channel();

	/**
	 * @param MustVerifyPhoneContract $verifiable
	 * @param string                  $code
	 * @return mixed
	 */
	public function buildVerifyRequest($verifiable, $code = null);

	/**
	 * @param $code
	 * @param $verification
	 * @return boolean
	 */
	public function check($code, $verification);

}
