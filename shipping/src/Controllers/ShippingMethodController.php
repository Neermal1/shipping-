<?php

namespace Bsdev\Shipping\Controllers;

use App\Http\Controllers\Controller;
use Bsdev\Shipping\DataTables\ShippingMethodDataTable;
use Bsdev\Shipping\Models\ShippingMethod;
use Bsdev\Shipping\Requests\StoreShippingMethodRequest;
use Bsdev\Shipping\Requests\UpdateShippingMethodRequest;
use Illuminate\Http\Request;

class ShippingMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ShippingMethodDataTable $dataTable)
    {
        abort_if(!auth()->user()->can('shipping_view'), 403);

        return $dataTable->render('shipping::method.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!auth()->user()->can('shipping_create'), 403);

        return view('shipping::method.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShippingMethodRequest $request)
    {
        abort_if(!auth()->user()->can('shipping_create'), 403);

        try {
            $data = $request->validated();

            ShippingMethod::create($data);

            return redirect()->route('shippingmethods.index')->with('success', 'Successfully Created!!');
        } catch (\Exception $ex) {

            return redirect()->route('shippingmethods.index')->with('error', 'Something went wrong!');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ShippingMethod $shippingMethod)
    {
        abort_if(!auth()->user()->can('shipping_edit'), 403);

        return view('shipping::method.edit', compact('shippingMethod'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShippingMethodRequest $request, ShippingMethod $shippingMethod)
    {
        abort_if(!auth()->user()->can('shipping_update'), 403);

        try {
            $data = $request->validated();

            $data['status'] = $request->status ? 1 : 0;
            $shippingMethod->update($data);

            return redirect()->route('shippingmethods.index')->with('success', 'Successfully Updated!!');
        } catch (\Exception $ex) {

            return redirect()->route('shippingmethods.index')->with('error', 'Something went wrong!');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShippingMethod $shippingMethod)
    {
        abort_if(!auth()->user()->can('shipping_delete'), 403);

        try {
            
               if ($shippingMethod->shippings > 0) {
                return redirect()->route('shippingmethods.index')->with('error', 'Methods has many shipping');
            }

            $shippingMethod->delete();

            return redirect()->route('shippingmethods.index')->with('success', 'Successfully Delteted!!');

        } catch (\Exception $ex) {

            return redirect()->route('shippingmethods.index')->with('error', 'Something went wrong!');

        }
    }
}
