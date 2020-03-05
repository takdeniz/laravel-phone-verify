<?php
namespace Takdeniz\PhoneVerify\Events;

use Illuminate\Queue\SerializesModels;
use Takdeniz\PhoneVerify\Contracts\MustVerifyPhoneContract;

class PhoneVerified
{
	use SerializesModels;

	/**
	 * The verified user.
	 *
	 * @var \Illuminate\Contracts\Auth\MustVerifyEmail
	 */
	public $user;

	/**
	 * Create a new event instance.
	 *
	 * @param MustVerifyPhoneContract $user
	 * @return void
	 */
	public function __construct($user)
	{
		$this->user = $user;
	}
}
