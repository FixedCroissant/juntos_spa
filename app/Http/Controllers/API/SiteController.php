<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

use App\Models\Sites;
use App\Models\County;
use Illuminate\Http\Request;
use App\Http\Resources\SiteResource;

class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sites = Sites::with(['County:id,county_name'])
        ->select('id','county_id','site_name')->get();

        return response([ 'sites' => $sites, 'message' => 'Sites Retrieved successfully'], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Not created automatically with the API. Need manual method made.
        // Get all counties
        $counties = County::select('id','county_name')->orderBy('county_name','ASC')->get();

        return response(['counties'=>$counties, 'message' => 'Create Sites Retrieved successfully'], 200);
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
             'county' => 'required',
             'site_name' => 'required'
         ]);

        //Validation
         if($validator->fails()){
             return response(['error' => $validator->errors(), 'Validation Error']);
         }
        
        $site = Sites::create(['county_id'=>$request->county,'site_name'=>$request->site_name]);

        return response([ 'site' => new SiteResource($site), 'message' => 'Created Site','status'=>200], 200);
    
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         //Since API resource used as a edit..
         $site = Sites::with('County:id,county_name')->where('id',$id)->first();
         return response([ 'site' => $site, 'message' => 'Selected Site Retrieved successfully'], 200);
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\site  $site
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $site = sites::find($id);
        $site->update($request->all());

        return response([ 'site' => $site, 'message' => 'Selected Site Updated successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $site=sites::find($id);
        $site->delete();

        return response(['message' => 'Site Deleted'],200);
    }
}
