<?php

namespace Bsdev\Shipping\Facades;

use Illuminate\Support\Facades\Facade;

class ShippingFacade extends Facade
{

    public static function getFacadeAccessor()
    {
        return 'shipping';
    }
}
