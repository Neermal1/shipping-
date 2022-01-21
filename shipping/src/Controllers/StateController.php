<?php

namespace Bsdev\Shipping\Controllers;

use App\Http\Controllers\Controller;
use Bsdev\Shipping\DataTables\StateDataTable;
use Bsdev\Shipping\Models\State;
use Bsdev\Shipping\Requests\StoreStateRequest;
use Bsdev\Shipping\Requests\UpdateStateRequest;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StateDataTable $dataTable)
    {
        abort_if(!auth()->user()->can('shipping_view'), 403);

        return $dataTable->render('shipping::state.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!auth()->user()->can('shipping_create'), 403);

        return view('shipping::state.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStateRequest $request)
    {
        abort_if(!auth()->user()->can('shipping_create'), 403);

        try {

            $data = $request->validated();
            State::create($data);

            return redirect()->route('states.index')->with('success', 'Successfully Created!!');

        } catch (\Exception $ex) {

            return redirect()->route('states.index')->with('error', 'Something went wrong!!' . $ex->getMessage());

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
    public function edit(State $state)
    {
        abort_if(!auth()->user()->can('shipping_edit'), 403);

        return view('shipping::state.edit', compact('state'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStateRequest $request, State $state)
    {
        abort_if(!auth()->user()->can('shipping_update'), 403);

        try {

            $data = $request->validated();
            $data['status'] = $request->status ? 1 : 0;
            $state->update($data);

            return redirect()->route('states.index')->with('success', 'Successfully Updated!!');

        } catch (\Exception $ex) {

            return redirect()->route('states.index')->with('error', 'Something went wrong!!');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(State $state)
    {
        abort_if(!auth()->user()->can('shipping_delete'), 403);

        try {
             if ($state->districts > 0) {
                return redirect()->route('states.index')->with('error', 'State has many districts');
            }
            $state->delete();
            return redirect()->route('states.index')->with('success', 'Successfully Delete!!');

        } catch (\Exception $ex) {

            return redirect()->route('states.index')->with('error', 'Something went wrong!!');

        }
    }
}
