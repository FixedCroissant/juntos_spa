<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\States;
use Illuminate\Http\Request;


class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get all states
        $states = States::all();


        return view('pages.admin.states.index')->with(['states'=>$states]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.states.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Save a new site.
        $data = $request->all();

        $validator = \Validator::make($data, [
            'state_name' => 'required',
            'state_abbreviation'=>'required'
        ]);

        //Validation
        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }
        $state = States::create(['state_name'=>$request->state_name,'state_abbreviation'=>$request->state_abbreviation]);
        return redirect()->route('admin.states.index')->with('flash_success','New State Successfully Created!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $state = States::find($id);


        return view('pages.admin.states.edit')->with(['state'=>$state]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $state = States::find($id);
        $state = States::find($id);
        $state->update($request->all());

        return redirect()->route('admin.states.index')->with('flash_success','State Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
