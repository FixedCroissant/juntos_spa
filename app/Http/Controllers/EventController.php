<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\Sites;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
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
        $events = DB::table('events')
            ->leftJoin('sites','events.site_id','=','sites.id')
            ->select('events.id','events.site_id','sites.site_name','events.*')
            ->whereIn('site_id',$userSites)
            ->get();


        return view('pages.events.index')->with(['events'=>$events]);

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
        return view('pages.events.create')->with(['siteOption'=>$siteOption,'stateOptions'=>$stateOptions]);
    }

    public function show($id){
        $event = Event::find($id);
        //Get additional family members that may be attending.
        $siblingTotals = \DB::table('event_attendance')->where('event_id',$id)->select(\DB::raw('sibling_number+other_guests_number AS totalOtherGuest'),'sibling_number','other_guests_number','event_id')->distinct()->get();
        $eventSite = Sites::find($event->site_id);

        return view('pages.events.show')->with(['event'=>$event,'siblingandguests'=>$siblingTotals,'eventSite'=>$eventSite]);
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
            'event_start_date' => 'required|max:255',
            'event_end_date' => 'required|max:255',
            'event_name' => 'required',
            'event_type' => 'required',
            'event_city' => 'required',
            'event_state' => 'required',
            'contact_hours'=>'required',
            'site_id'=>'required'

        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        Event::create($data);

        return redirect()->route('event.index')->with('flash_success','New Event Created!');

    }

    public function edit($id){

        $user = Auth::user();
        $siteOption = $user->studentAccess()->select('sites.id','site_name')->get();
        $loggedInUser = auth()->user();
        $userSites=[];
        foreach($loggedInUser->studentAccess as $siteAccess){
            $userSites[]=$siteAccess->pivot->site_id;
        }

        $stateOptions = ['NC'=>'North Carolina'];

        $event = Event::find($id)->whereIn('site_id',$userSites)->first();

        if(is_null($event)){
            return back()->with(['flash_warning'=>'No access contact Juntos Admin.']);
        }

        return view('pages.events.edit')->with(['siteOption'=>$siteOption,'stateOptions'=>$stateOptions,'event'=>$event]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Event $event
     */
    public function update(Request $request, Event $event)
    {
        $event->update($request->all());

        return redirect()->route('event.index')->with('flash_success','Event Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();


        return redirect()->route('event.index')->with('flash_success','Event Deleted!');
    }


    /**
     * Update sibling category.
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateSibling($id, Request $request){
            DB::table('event_attendance')
            ->where('event_id',$id)
            ->update(['sibling_number'=>$request->sibling_number]);

        return redirect()->back()->with('flash_message','Sibling Attendance Updated');
    }

    /**
     * Update other guest category.
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateOtherGuest($id,Request $request){
        DB::table('event_attendance')
            ->where('event_id',$id)
            ->update(['other_guests_number'=>$request->other_guests_number]);

        return redirect()->back()->with('flash_message','Other Guest Attendance Updated');
    }

}
