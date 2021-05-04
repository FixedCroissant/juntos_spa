<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Sites;
use App\Models\County;
use Illuminate\Http\Request;


class SiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get All Sites
        $sites = Sites::with(['County:id,county_name'])
            ->select('id','county_id','site_name')->get();

        return view('pages.admin.sites.index')->with(['sites'=>$sites]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countyOptions = County::pluck('county_name','id');

        return view('pages.admin.sites.create')->with(['countyOptions'=>$countyOptions]);
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

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $site = Sites::create(['county_id'=>$request->county,'site_name'=>$request->site_name]);


        return redirect()->route('admin.sites.index')->with('flash_success','New Site Successfully Created!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $site = Sites::with('County:id,county_name')->where('id',$id)->first();

        return view('pages.admin.sites.edit')->with(['site'=>$site]);
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
        $site = sites::find($id);
        $site->update($request->all());

        return redirect()->route('admin.sites.index')->with('flash_success','Site Successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $site=sites::find($id);
        $site->delete();

        return redirect()->route('admin.sites.index')->with('flash_success','Site Successfully Deleted!');

    }
}
