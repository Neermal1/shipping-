<?php
namespace Bsdev\Shipping\Facades;

use Bsdev\Shipping\Models\Area;
use Bsdev\Shipping\Models\Cluster;
use Bsdev\Shipping\Models\District;
use Bsdev\Shipping\Models\ShippingMethod;
use Bsdev\Shipping\Models\State;
use Theme;

class Shipping
{
    public function getStates()
    {
        return State::orderBy('position', 'ASC')->get();
    }
    public function getDistricts()
    {
        return District::orderBy('position', 'ASC')->get();
    }
    public function getAreas()
    {
        return Area::orderBy('position', 'ASC')->get();
    }
    public function getClusters()
    {
        return Cluster::orderBy('updated_at', 'DESC')->get();
    }
    public function getMethods()
    {
        return ShippingMethod::all();
    }

    public function getMenu()
    {

        if (!Theme::checkModuleStatus('Shipping')) {
            return '';
        }
        return view('shipping::menu');
    }
    public function getPermissions()
    {
        if (!Theme::checkModuleStatus('Shipping')) {
            return [];
        }
        return [
            'shipping_create',
            'shipping_view',
            'shipping_edit',
            'shipping_update',
            'shipping_delete',
            'shipping_menu',
        ];

    }
}
