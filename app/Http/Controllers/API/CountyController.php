<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\county;
use App\Models\States;
use Illuminate\Http\Request;
use App\Http\Resources\CountyResource;


class CountyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $counties = County::with('State:id,state_name')->select('id','state_id','county_name')->orderBy('county_name','ASC')->get();

        return response([ 'counties' => $counties, 'message' => 'State Counties Retrieved successfully'], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Not created automatically with the API. Need manual method made.
        // Get all states
        $states = States::select('id','state_name')->orderBy('state_name','ASC')->get();

        return response(['states'=>$states,'message' => 'Create Counties Retrieved successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $data = $request->all();
        
         $validator = \Validator::make($data, [
             'state' => 'required',
             'county_name' => 'required'
         ]);

         if($validator->fails()){
             return response(['error' => $validator->errors(), 'Validation Error']);
         }
        
        $county = County::create(['state_id'=>$request->state,'county_name'=>$request->county_name]);

        return response([ 'county' => new CountyResource($county), 'message' => 'Created County','status'=>200], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\county  $county
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          //Since API resource used as a edit..
          $county = county::with('State:id,state_name')->where('id',$id)->first();
          return response([ 'county' => $county, 'message' => 'Selected County Retrieved successfully'], 200);

    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $county = county::find($id);
        $county->update($request->all());
        return response([ 'county' => $county, 'message' => 'Selected County Updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\county  $county
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $county = county::find($id);
        $county->delete();

        return response(['message' => 'County Deleted'],200);
    }
}
