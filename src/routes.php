<?php
Route::post('/phone/verify', 'Takdeniz\PhoneVerify\Controllers\VerificationController@verify')
	->name('phone.verify');
Route::post('/phone/verify/resend', 'Takdeniz\PhoneVerify\Controllers\VerificationController@resend')
	->name('phone.resend');
