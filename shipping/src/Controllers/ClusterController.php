<?php

namespace Bsdev\Shipping\Controllers;

use App\Http\Controllers\Controller;
use Bsdev\Shipping\DataTables\ClusterDataTable;
use Bsdev\Shipping\Models\Cluster;
use Bsdev\Shipping\Requests\StoreClusterRequest;
use Bsdev\Shipping\Requests\UpdateClusterRequest;
use Illuminate\Http\Request;

class ClusterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ClusterDataTable $dataTable)
    {
        abort_if(!auth()->user()->can('shipping_view'), 403);

        return $dataTable->render('shipping::cluster.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!auth()->user()->can('shipping_create'), 403);

        return view('shipping::cluster.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClusterRequest $request)
    {
        abort_if(!auth()->user()->can('shipping_create'), 403);

        try {
            $data = $request->validated();
            $cluster = Cluster::create($data);
            $cluster->areas()->sync($request->areas);
            return redirect()->route('clusters.index')->with('success', 'Successfully Created!!');
        } catch (\Exception $ex) {

            return redirect()->route('clusters.index')->with('error', 'Something went wrong!!');

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
    public function edit(Cluster $cluster)
    {
        abort_if(!auth()->user()->can('shipping_edit'), 403);

        return view('shipping::cluster.edit', compact('cluster'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClusterRequest $request, Cluster $cluster)
    {
        abort_if(!auth()->user()->can('shipping_update'), 403);

        try {

            $data = $request->validated();
            $data['status'] = $request->status ? 1 : 0;
            $cluster->update($data);
            $cluster->areas()->sync($request->areas);

            return redirect()->route('clusters.index')->with('success', 'Successfully Updated!!');

        } catch (\Exception $ex) {

            return redirect()->route('clusters.index')->with('error', 'Something went wrong!!');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cluster $cluster)
    {
        abort_if(!auth()->user()->can('shipping_delete'), 403);

        try {

            if (count($cluster->shippings) > 0) {

                return redirect()->route('clusters.index')->with('error', 'Cluster is in shipping, remove from shipping and try again!!');

            }
            $cluster->areas()->sync([]);
            $cluster->delete();

            return redirect()->route('clusters.index')->with('success', 'Successfully Deleted!!');
        } catch (\Exception $ex) {

            return redirect()->route('clusters.index')->with('error', 'Something went wrong!!');

        }
    }
}
