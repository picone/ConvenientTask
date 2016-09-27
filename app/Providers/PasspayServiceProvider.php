<?php

namespace App\Providers;

use App\Services\PasspayService;
use Illuminate\Support\ServiceProvider;

class PasspayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('passpay',function(){
            return new PasspayService();
        });
    }
}
