<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Console\Events\CommandFinished;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        // delete access tokens
        // 'Laravel\Passport\Events\AccessTokenCreated' => [
        //     'App\Listeners\RevokeOldTokens'
        // ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // to create passport install automatically after migrate:fresh command
        Event::listen(CommandFinished::class, function (CommandFinished $event) {
            if ($event->command === 'migrate:fresh') {
                Artisan::call('passport:install', ['--force' => true]);
                echo Artisan::output();
            }
        });
    }
}
