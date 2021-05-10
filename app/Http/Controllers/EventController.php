<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;

class EventController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::select('id','event_name','event_type','event_city','event_state','event_start_date','event_end_date')->get();

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
        return view('pages.events.create')->with(['stateOptions'=>$stateOptions]);
    }

    public function show($id){
        $event = Event::find($id);
        return view('pages.events.show')->with(['event'=>$event]);
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
            'contact_hours'=>'required'

        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        Event::create($data);

        return redirect()->route('event.index')->with('flash_success','New Event Created!');

    }

    public function edit($id){
        $stateOptions = ['NC'=>'North Carolina'];

        $event = Event::find($id);

        return view('pages.events.edit')->with(['stateOptions'=>$stateOptions,'event'=>$event]);
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


}
