<?php

namespace App\Providers;

use App\Packt\PacktApi;
use Illuminate\Support\ServiceProvider;

class PacktServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('packt',function(){
            return new PacktApi();
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
