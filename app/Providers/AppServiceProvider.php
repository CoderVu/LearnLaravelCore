<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Services\UserService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        parent::register(); // Optional, only if you override parent logic
        $this->registerRepositories();
        $this->registerServices();
    }

    /**
     * Register the application's repositories.
     *
     * @return void
     */
    protected function registerRepositories()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Register the application's services.
     *
     * @return void
     */
    protected function registerServices()
    {
        $this->app->singleton(UserService::class, function ($app) {
            return new UserService($app->make(UserRepositoryInterface::class));
        });
    }
}