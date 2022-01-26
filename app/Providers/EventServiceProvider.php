<?php

namespace App\Providers;

use App\Events\BingoEvent;
use App\Events\TestEvent;
use App\Events\WelcomeEvent;
use App\Listeners\BingoListener;
use App\Listeners\BingoListener2;
use App\Listeners\SendTestNotificaion;
use App\Listeners\WelcomeListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

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
        BingoEvent::class => [
            BingoListener::class,
            BingoListener2::class
        ],
        WelcomeEvent::class => [
            WelcomeListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
