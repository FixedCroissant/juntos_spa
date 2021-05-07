<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Student;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VolunteerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $volunteers= Volunteer::all();

        return view('pages.volunteer.index')->with(['volunteers'=>$volunteers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stateOptions = ['NC'=>'North Carolina'];
        $user = Auth::user();
        $siteOption = $user->studentAccess()->select('sites.id','site_name')->get();
        return view('pages.volunteer.create')->with(['siteOption'=>$siteOption,'stateOptions'=>$stateOptions]);
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
            'volunteer_first_name' => 'required|max:255',
            'volunteer_last_name' => 'required|max:255',
            'address_line_1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'site_id'=>'required'
        ]);

        //Validation
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        volunteer::create($data);

        return redirect()->route('volunteer.index')->with('flash_success','New Volunteer created!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function edit(Volunteer $volunteer)
    {
        $stateOptions = ['NC'=>'North Carolina'];
        $user = Auth::user();
        $siteOption = $user->studentAccess()->select('sites.id','site_name')->get();

        return view('pages.volunteer.edit')->with(['siteOption'=>$siteOption,'volunteer'=>$volunteer,'stateOptions'=>$stateOptions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Volunteer  $volunteer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Volunteer $volunteer)
    {
        $volunteer->update($request->all());

        return redirect()->route('volunteer.index')->with('flash_success','Volunteer Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $volunteer = Volunteer::find($id);
        $volunteer->delete();
        return back()->with('flash_success','Volunteer Deleted!');
    }

    /**
     * Additional methods.
     */
    public function addEventAttendance(Request $request){
        $attendees  = array_unique($request->id);

        $selectedVolunteerInformation = Volunteer::whereIn('id',$attendees)->select('id','volunteer_first_name','volunteer_last_name')->get();

        $eventOptions = Event::pluck('event_name','id');


        return view('pages.volunteer.eventadd')->with(['selectedVolunteers'=>$selectedVolunteerInformation,'eventOptions'=>$eventOptions]);
    }
}
