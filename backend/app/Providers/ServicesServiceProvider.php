<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\{
    AuthService
};
use App\Services\Contracts\{
    AuthServiceInterface
};

class ServicesServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        AuthServiceInterface::class => AuthService::class
    ];

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
        //
    }
}
