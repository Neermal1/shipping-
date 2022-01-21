<?php

namespace Bsdev\Shipping;

use Bsdev\Shipping\Facades\Shipping;
use Illuminate\Support\ServiceProvider;

class ShippingServiceProvider extends ServiceProvider
{
    public function boot()
    {

        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadViewsFrom(__DIR__ . '/views', 'shipping');

    }
    public function register()
    {
        $this->app->bind('shipping', function () {
            return new Shipping;
        });
    }
}
