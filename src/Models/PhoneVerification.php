<?php
namespace Takdeniz\PhoneVerify\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PhoneVerify
 *
 * @package Wisdmlabs\Todolist
 * @author  Tuncay Akdeniz <akdeniztuncay44@gmail.com>
 * @version 0.1
 * @since   0.1
 * @see     \CreatePhoneVerificationsTable
 */
class PhoneVerification extends Model
{
	protected $table = 'phone_verifications';

	protected $fillable = [
		'phone_number', 'code','channel'
	];
}
