<?php

namespace App\Providers;

use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class UserServiceFacadeProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('userServiceFacade', function () {
            return new UserService();
        });
    }
}
