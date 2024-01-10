<?php

namespace App\Providers;

use App\Contracts\ProductsInterface;
use App\Repositories\ProductsRepository;
use App\Contracts\CartsInterface;
use App\Repositories\CartssRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductsInterface::class, ProductsRepository::class);
        $this->app->bind(CartsInterface::class, CartsRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrapFive();
    }
}
