<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Http\Resources\EventResource;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //convert to db builder
        $events = \DB::table('events')
        //->join('parents', 'students.id', '=', 'parents.student_id')
        //->leftJoin('schools', 'students.school_id', '=', 'schools.id')
        ->select('id','event_name','event_type','event_city','event_state','event_start_date','event_end_date')
        ->get();


        return response([ 'events' => $events, 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
             
         ]);

        //Validation
         if($validator->fails()){
             return response(['error' => $validator->errors(), 'Validation Error']);
         }

        $event = Event::create($data);

        return response([ 'event' => new EventResource($event), 'message' => 'Created Event','status'=>200], 200);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Attendenace Information as well.
        $myEvent = Event::find($id);

        //Attendance Information here
        //TODO REMOVE VALUES THAT ARE NOT NEEDED IN LOOK UP
        //CURRENTLY PROVIDING WAY TOO MUCH INFORMATION.
        $attendance=$myEvent->attendance;

        //This is also being used in /events/{id}/attendance/

        //Also get parent attendance.
        $parentAttendance = $myEvent->parentAttendance;


        return response([ 'event' => new EventResource($myEvent), 'message' => 'Retrived Event','status'=>200], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
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

        return response(['message' => 'Event Deleted'],200);
    }

    
    /**
     * Create new Attendance for Student/Parent/Voltunteer Record
     */
    public function addAttendance(Request $request, $id){
        $MyEvent = Event::find($id);
        //Check Parents...
        if($request->parents){
            foreach($request->attendees as $myAttendanceToAdd){
                //Specifically parents.
                $attendanceSaved = $MyEvent->parentAttendance()->attach($myAttendanceToAdd);
            }   
        }
        //Students Attendance
        else if($request->students){
                     foreach($request->attendees as $myAttendanceToAdd){
                         $attendanceSaved = $MyEvent->attendance()->attach($myAttendanceToAdd);
                     }
         }

        return response([ 'attendance' => $attendanceSaved, 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Remove a {student}/person from attendance
     */
    public function removeAttendance(Request $request, $id){
     
        //What event are we looking for to add attendance?
        $MyEvent = Event::find($id);
       
       //Remove just one person based on the specific event id; and the "student_id" from the 
       //event_attendance table.
       $attendanceSaved = $MyEvent->attendance()->detach($request->attendeesToRemove);

        return response([ 'attendance' => $attendanceSaved, 'message' => 'Retrieved successfully'], 200);
    }

}
