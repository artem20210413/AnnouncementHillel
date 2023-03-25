<?php

namespace App\Providers;

use App\Mail\MailgunMail;
use App\Services\Mail\MailMailgunService;
use App\Services\Mail\MailService;
use Illuminate\Support\ServiceProvider;

class MailProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('kayMailFacade', function () {
            return new MailMailgunService();
//            return new MailService();
        }
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
