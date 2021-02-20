<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \App\Repositories\Cart\CartRepository::class,
            \App\Repositories\Cart\EloquentCart::class
        );
        $this->app->singleton(
            \App\Repositories\Category\CategoryRepository::class,
            \App\Repositories\Category\EloquentCategory::class
        );
        $this->app->singleton(
            \App\Repositories\Order\OrderRepository::class,
            \App\Repositories\Order\EloquentOrder::class
        );
        $this->app->singleton(
            \App\Repositories\Product\ProductRepository::class,
            \App\Repositories\Product\EloquentProduct::class
        );
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
