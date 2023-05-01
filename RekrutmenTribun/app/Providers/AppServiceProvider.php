<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Htpp\Controllers\LamaranController;
use Illuminate\Support\Facades\Blade;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind('LamaranController', function ($app) {
            return new LamaranController();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(){
        
    }
}
