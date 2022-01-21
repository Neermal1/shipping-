<?php

namespace Bsdev\Shipping\Controllers;

use App\Http\Controllers\Controller;
use Bsdev\Shipping\DataTables\ShippingDataTable;
use Bsdev\Shipping\Models\Shipping;
use Bsdev\Shipping\Requests\StoreShippingRequest;
use Bsdev\Shipping\Requests\UpdateShippingRequest;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ShippingDataTable $dataTable)
    {
        abort_if(!auth()->user()->can('shipping_view'), 403);

        return $dataTable->render('shipping::shipping.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!auth()->user()->can('shipping_create'), 403);

        return view('shipping::shipping.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreShippingRequest $request)
    {
        abort_if(!auth()->user()->can('shipping_create'), 403);

        try {
            $data = $request->validated();

            $shipping = Shipping::create($data);
            $shipping->clusters()->sync($request->clusters);

            return redirect()->route('shippings.index')->with('success', 'Successfully Created!!');
        } catch (\Exception $ex) {

            return redirect()->route('shippings.index')->with('error', 'Something went wrong!!');

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
    public function edit(Shipping $shipping)
    {
        abort_if(!auth()->user()->can('shipping_edit'), 403);

        return view('shipping::shipping.edit', compact('shipping'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateShippingRequest $request, Shipping $shipping)
    {
        abort_if(!auth()->user()->can('shipping_update'), 403);

        try {
            $data = $request->validated();

            $data['status'] = $request->status ? 1 : 0;

            $shipping->update($data);

            $shipping->clusters()->sync($request->clusters);

            return redirect()->route('shippings.index')->with('success', 'Successfully Updated!!');
        } catch (\Exception $ex) {

            return redirect()->route('shippings.index')->with('error', 'Something went wrong!!');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shipping $shipping)
    {
        abort_if(!auth()->user()->can('shipping_delete'), 403);

        try {

             if ($shipping->orders > 0) {
                return redirect()->route('shippings.index')->with('error', 'Shipping has many orders');
            }
            $shipping->clusters()->sync([]);
            $shipping->delete();

            return redirect()->route('shippings.index')->with('success', 'Successfully Deleted!!');

        } catch (\Exception $ex) {

            return redirect()->route('shippings.index')->with('error', 'Something went wrong!!');

        }
    }
}
