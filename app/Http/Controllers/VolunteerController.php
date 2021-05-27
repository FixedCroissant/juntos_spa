<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VolunteerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loggedInUser = auth()->user();
        $userSites=[];
        foreach($loggedInUser->studentAccess as $siteAccess){
            $userSites[]=$siteAccess->pivot->site_id;
        }
        $volunteers = DB::table('volunteers')
                      ->leftJoin('sites','volunteers.site_id','=','sites.id')
                      ->select('volunteers.id','volunteers.site_id','volunteers.volunteer_first_name','volunteers.volunteer_last_name','volunteers.email_address','volunteers.phone_number','sites.site_name')
                      ->whereIn('site_id',$userSites)
                      ->get();

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

        $loggedInUser = auth()->user();
        $userSites=[];
        foreach($loggedInUser->studentAccess as $siteAccess){
            $userSites[]=$siteAccess->pivot->site_id;
        }
        $volunteer = Volunteer::find($volunteer['id'])->whereIn('site_id',$userSites)->first();

        if(is_null($volunteer)){
         return back()->with(['flash_warning'=>'No access contact Juntos Admin.']);
        }

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
        if(is_null($request->id)){
            return redirect()->back()->with(['flash_warning'=>'Please select an individual to add']);
        }
        $attendees  = array_unique($request->id);

        $selectedVolunteerInformation = Volunteer::whereIn('id',$attendees)->select('id','volunteer_first_name','volunteer_last_name')->get();

        $eventOptions = Event::select(
            \DB::raw("CONCAT(date_format(event_start_date, ' %c/%e/%y'),' to ',date_format(event_end_date,'%c/%e/%y')) AS eventTimes"),'event_name','id'
        )->get();



        return view('pages.volunteer.eventadd')->with(['selectedVolunteers'=>$selectedVolunteerInformation,'eventOptions'=>$eventOptions]);
    }

    /**
     * Add event attendance for a volunteer
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addEventAttendanceComplete(Request $request){

        $MyEvent = Event::find($request->eventOptions);

        $attendees = json_decode($request->volunteers);

        if($MyEvent==NULL){
            return redirect()->route('volunteer.index')->with('flash_warning','Please select an event from dropdown, cannot add attendance.');
        }

        foreach($attendees as $volunteerAttendees){
            $MyEvent->volunteerAttendance()->syncWithoutDetaching($volunteerAttendees->id);
        }

        return redirect()->route('volunteer.index')->with('flash_success','Volunteer Attendance Added!');
    }

    /*
     * Remove a volunteer record from our attendance list.
     */
    public function removeEventAttendanceComplete($event,$id)
    {
        $myEvent = Event::find($event);
        $myEvent->volunteerAttendance()->detach($id);
        return redirect()->route('event.show',[$myEvent->id])->with('flash_success','Volunteer Attendance Removed!');
    }






/**
 * Route::post('/volunteer/attendance',['as'=>'volunteer.addeventattendance','uses'=>'App\Http\Controllers\VolunteerController@addEventAttendance']);
Route::post('/volunteer/attendance/complete',['as'=>'volunteer.completeAttendance','uses'=>'App\Http\Controllers\VolunteerController@addEventAttendanceComplete']);
Route::get('/volunteer/attendance/remove/{eventID}/{id}',['as'=>'volunteer.removeAttendance','uses'=>'App\Http\Controllers\VolunteerController@removeEventAttendanceComplete']);

 */



}
