<?php
use Bsdev\Shipping\Controllers\AreaController;
use Bsdev\Shipping\Controllers\ClusterController;
use Bsdev\Shipping\Controllers\DistrictController;
use Bsdev\Shipping\Controllers\ShippingController;
use Bsdev\Shipping\Controllers\ShippingMethodController;
use Bsdev\Shipping\Controllers\StateController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['web', 'auth'], 'prefix' => 'backend/shipping'], function () {
    Route::resource('states', StateController::class)->names('states');
    Route::resource('districts', DistrictController::class)->names('districts');
    Route::resource('areas', AreaController::class)->names('areas');
    Route::resource('clusters', ClusterController::class)->names('clusters');
    Route::resource('shipping-methods', ShippingMethodController::class)->names('shippingmethods');
    Route::resource('shippings', ShippingController::class)->names('shippings');
});
