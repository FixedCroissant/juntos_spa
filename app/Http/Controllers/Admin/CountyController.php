<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\County;
use App\Models\States;
use Illuminate\Http\Request;


class CountyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get all Counties
        $counties = County::with('State:id,state_name')
            ->select('id','state_id','county_name')->orderBy('county_name','ASC')->get();

        return view('pages.admin.counties.index')->with(['counties'=>$counties]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stateOptions = States::pluck('state_name','id');

        return view('pages.admin.counties.create')->with(['stateOptions'=>$stateOptions]);
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
            'state' => 'required',
            'county_name' => 'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $county = County::create(['state_id'=>$request->state,'county_name'=>$request->county_name]);


        return redirect()->route('admin.counties.index')->with('flash_success','New County Successfully Created!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $county = County::find($id);


        return view('pages.admin.counties.edit')->with(['county'=>$county]);
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
        $county = county::find($id);
        $county->update($request->all());

        return redirect()->route('admin.counties.index')->with('flash_success','County Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $county = county::find($id);
        $county->delete();

        return redirect()->route('admin.counties.index')->with('flash_success','County Deleted');
    }
}
