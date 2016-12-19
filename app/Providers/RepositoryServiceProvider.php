<?php

namespace CodEditora\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(\CodEditora\Repositories\CategoryRepository::class, \CodEditora\Repositories\CategoryRepositoryEloquent::class);
        $this->app->bind(\CodEditora\Repositories\UserRepository::class, \CodEditora\Repositories\UserRepositoryEloquent::class);
        $this->app->bind(\CodEditora\Repositories\BookRepository::class, \CodEditora\Repositories\BookRepositoryEloquent::class);
        //:end-bindings:
    }
}
