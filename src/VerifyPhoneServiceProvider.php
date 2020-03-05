<?php
namespace Takdeniz\PhoneVerify;

use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Takdeniz\PhoneVerify\Listeners\SendPhoneVerificationNotification;

class VerifyPhoneServiceProvider extends ServiceProvider
{
	/**
	 * The event listener mappings for the application.
	 *
	 * @var array
	 */
	protected $listen = [
		Registered::class => [
			SendPhoneVerificationNotification::class,
		],
	];

	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		parent::boot();

		$this->loadRoutesFrom(__DIR__ . '/routes.php');
		$this->loadMigrationsFrom(dirname(__DIR__) . '/database/migrations');

		if (function_exists('config_path')) {
			$this->publishes([
				dirname(__DIR__) . '/config/config.php' => config_path('verify.php'),
			], 'laravel-phone-verify-config');
		}

		$this->publishes([
			dirname(__DIR__) . '/database/migrations' => database_path('migrations'),
		], 'laravel-phone-verify-migrations');

	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->make('Takdeniz\PhoneVerify\Controllers\VerificationController');
	}
}
