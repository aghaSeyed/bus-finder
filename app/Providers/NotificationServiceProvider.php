<?php

namespace App\Providers;

use App\Contracts\NotificationService;
use App\Services\EmailApi;
use App\Services\SmsApi;
use Illuminate\Support\ServiceProvider;
use RuntimeException;

class NotificationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(NotificationService::class, function ($app) {
            return match (config('services.provider.notification')) {
                'sms' => new SmsApi(),
                'email' => new EmailApi(),
                default => throw new RuntimeException('The notification service driver is invalid.'),
            };
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
