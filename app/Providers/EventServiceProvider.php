<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Auth\Events\Registered;
use App\Listeners\SendWelcomeEmail;

class EventServiceProvider extends ServiceProvider
{
    
        protected $listen = [
            \Illuminate\Auth\Events\Verified::class => [
                \App\Listeners\SendWelcomeEmailOnVerification::class,
            ],
        ];
        

    public function boot(): void
    {
        //
    }
}