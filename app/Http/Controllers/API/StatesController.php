<?php

namespace App\Http\Controllers\API;

use App\Models\States;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\StateResource;

class StatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $states = States::select('id','state_name','state_abbreviation')->get();

        return response([ 'states' => $states, 'message' => 'States Retrieved successfully'], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Not created automatically with the API. Need manual method made.
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

        return response([ 'state' => new StateResource($state), 'message' => 'Created State','status'=>200], 200);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $state = States::find($id);

        return response([ 'state' => $state, 'message' => 'Selected State Retrieved successfully'], 200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *    
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $state = States::find($id);
        $state->update($request->all());

        return response(['state'=>$state, 'message'=>'State updated successfully.'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $state = States::find($id);
        $state->delete();

        return response(['message'=>'State Deleted'],200);

    }
}
