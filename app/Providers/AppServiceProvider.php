<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\UserService;
use App\Contracts\IUserService;
use App\Repositories\UserRepository;
use App\Contracts\IUserRepository;
use App\Services\PizzaService;
use App\Contracts\IPizzaService;
use App\Repositories\PizzaRepository;
use App\Contracts\IPizzaRepository;
use App\Services\OrderService;
use App\Contracts\IOrderService;
use App\Repositories\OrderRepository;
use App\Contracts\IOrderRepository;
use Illuminate\Support\Facades\Schema;
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

        $this->app->bind(IUserService::class, UserService::class);
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IPizzaService::class, PizzaService::class);
        $this->app->bind(IPizzaRepository::class, PizzaRepository::class);
        $this->app->bind(IOrderService::class, OrderService::class);
        $this->app->bind(IOrderRepository::class, OrderRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
