<?php

namespace Bsdev\Shipping\Controllers;

use App\Http\Controllers\Controller;
use Bsdev\Shipping\DataTables\DistrictDataTable;
use Bsdev\Shipping\Models\District;
use Bsdev\Shipping\Requests\StoreDistrictRequest;
use Bsdev\Shipping\Requests\UpdateDistrictRequest;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DistrictDataTable $dataTable)
    {
        abort_if(!auth()->user()->can('shipping_view'), 403);

        return $dataTable->render('shipping::district.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!auth()->user()->can('shipping_create'), 403);

        return view('shipping::district.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDistrictRequest $request)
    {
        abort_if(!auth()->user()->can('shipping_create'), 403);

        try {
            $data = $request->validated();

            District::create($data);

            return redirect()->route('districts.index')->with('success', 'Successfully Created!!');
        } catch (\Exception $ex) {

            return redirect()->route('districts.index')->with('error', 'Something went worng!!');
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
    public function edit(District $district)
    {
        abort_if(!auth()->user()->can('shipping_edit'), 403);

        return view('shipping::district.edit', compact('district'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDistrictRequest $request, District $district)
    {
        abort_if(!auth()->user()->can('shipping_update'), 403);

        try {
            $data = $request->validated();
            $data['status'] = $request->status ? 1 : 0;
            $district->update($data);

            return redirect()->route('districts.index')->with('success', 'Successfully Updated!!');
        } catch (\Exception $ex) {

            return redirect()->route('districts.index')->with('error', 'Something went worng!!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $district)
    {
        abort_if(!auth()->user()->can('shipping_delete'), 403);

        try {
            
            if ($district->areas > 0) {
                return redirect()->route('districts.index')->with('error', 'District has many areas');
            }
            $district->delete();

            return redirect()->route('districts.index')->with('success', 'Successfully Deleted!!');

        } catch (\Exception $ex) {

            return redirect()->route('districts.index')->with('error', 'Something went worng!!');
        }
    }
}
