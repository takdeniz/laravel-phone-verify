<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreatePhoneVerificationTable
 *
 * @author  Tuncay Akdeniz <akdeniztuncay44@gmail.com>
 * @version 0.1
 * @since   0.1
 */
class CreatePhoneVerificationsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('phone_verifications', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('phone_number');
			$table->string('code')->nullable();
			$table->string('channel')->nullable();
			$table->integer('active')->default(1);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('phone_verifications');
	}
}
