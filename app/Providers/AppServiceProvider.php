<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Src\CustomerManagement\Customers\Domain\CustomerRepository;
use Src\CustomerManagement\Customers\Infrastructure\Persistence\Eloquent\EloquentCustomerRepository;

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
        $this->app->bind(CustomerRepository::class, EloquentCustomerRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
