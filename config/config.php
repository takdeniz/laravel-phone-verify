<?php

use Takdeniz\PhoneVerify\Drivers\NetGSMVerify;
use Takdeniz\PhoneVerify\Drivers\NexmoVerify;

return [
	/**
	 * User model configuration.
	 */
	'user_class'         => '\App\User',

	/**
	 * phone number column on User model
	 */
	'phone_number_field' => 'phone_number',

	/**
	 * phone number column on User model
	 */
	'send_verify_sms'    => true,

	/**
	 * Allow sms resend timeout
	 */
	'allow_resend_in'    => 300,//in second

	/**
	 * default driver name
	 */
	'default'            => 'netgsm',

	/**
	 * available verification drivers
	 */
	'drivers'            => [
		'netgsm'       => NetGSMVerify::class,
		'nexmo_verify' => NexmoVerify::class,
	],

//	'driver_resolver' => [
//		'netgsm'       => '/^\+90/',
//		'nexmo_verify' => '/.*/'
//	]
];
