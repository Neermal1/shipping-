<?php

namespace Bsdev\Shipping\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Bsdev\Ecommerce\Models\Order;

class Shipping extends Model
{
    use HasFactory;
    protected $fillable = [
        'shipping_param',
        'shipping_param_min',
        'shipping_param_max',
        'time_param',
        'time_param_min',
        'time_param_max',
        'cost',
        'status',
        'shipping_method_id',
    ];

    public function clusters()
    {
        return $this->belongsToMany(Cluster::class);
    }

    public const SHIPPING_PARAM = [
        'weight',
    ];
    public const TIME_PARAM = [
        'minutes',
        'days',
        'weeks',
        'months',
        'years',
    ];

    public function shipping_method()
    {
        return $this->belongsTo(ShippingMethod::class);
    }
     public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
