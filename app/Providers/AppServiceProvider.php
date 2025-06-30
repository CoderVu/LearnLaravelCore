<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\UserRepository;

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
}