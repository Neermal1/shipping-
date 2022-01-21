<?php

namespace Bsdev\Shipping\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Bsdev\Shipping\DataTables\AreaDataTable;
use Bsdev\Shipping\Models\Area;
use Bsdev\Shipping\Requests\StoreAreaRequest;
use Bsdev\Shipping\Requests\UpdateAreaRequest;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AreaDataTable $dataTable)
    {
        abort_if(!auth()->user()->can('shipping_view'), 403);

        return $dataTable->render('shipping::area.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!auth()->user()->can('shipping_create'), 403);

        return view('shipping::area.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAreaRequest $request)
    {
        abort_if(!auth()->user()->can('shipping_create'), 403);

        try {
            $data = $request->validated();
            $data['status'] = $request->status?1:0;
            Area::create($data);

            return redirect()->route('areas.index')->with('success', 'Successfully Created!!');
        } catch (\Exception $ex) {

            return redirect()->route('areas.index')->with('error', 'Something went wrong!!');

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
    public function edit(Area $area)
    {
        abort_if(!auth()->user()->can('shipping_edit'), 403);

        return view('shipping::area.edit', compact('area'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAreaRequest $request, Area $area)
    {
        abort_if(!auth()->user()->can('shipping_update'), 403);

        try {
            $data = $request->validated();

            $data['status'] = $request->status ? 1 : 0;
            $area->update($data);

            return redirect()->route('areas.index')->with('success', 'Successfully updated!!');
        } catch (\Exception $ex) {

            return redirect()->route('areas.index')->with('error', 'Something went wrong!!');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        abort_if(!auth()->user()->can('shipping_delete'), 403);

        try {
            
             if (count($area->clusters) > 0) {

                return redirect()->route('areas.index')->with('error', 'Area is in clusters please remove from cluster before deleting!!');
            }

            $area->delete();

            return redirect()->route('areas.index')->with('success', 'Successfully Deleted!!');

        } catch (\Exception $ex) {

            return redirect()->route('areas.index')->with('error', 'Something went wrong!!');

        }
    }
}
