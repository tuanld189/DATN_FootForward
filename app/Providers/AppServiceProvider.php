<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
     public $serviceBindings=[
        // 'App\Services\Interfaces\UserServicesInterface'=>
        // 'App\Services\UserService',
        // 'App\Repositories\Interfaces\UserRepositoryInterface'=>
        // 'App\Repositories\UserRepository',
        'App\Repositories\Interfaces\ProvineRepositoryInterface'=>
        'App\Repositories\ProvineRepository',
    ];
    public function register(): void
    {
        // foreach($this->serviceBindings as $key=>$value){
        //     $this->app->bind($key, $value);
        // }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapThree();
    }
}
