<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

use App\Models\Student;
use App\Models\Parents;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ParentsController extends Controller
{

    public function index(){

        $user = Auth::user();

        $userSites=[];

        foreach($user->studentAccess as $siteAccess){
            $userSites[]=$siteAccess->pivot->site_id;
        }

        $parents = DB::table('parents')
            ->leftJoin('students','parents.student_id','=','students.id')
            ->leftJoin('sites', 'students.site_id', '=', 'sites.id')
            ->select('parents.id','parents.parent_first_name','parents.parent_last_name','parents.phone_number','parents.emailaddress','students.student_first_name',
               'students.student_last_name','students.site_id','sites.site_name')
            ->whereIn('site_id', $userSites)
            ->orderBy('parents.student_id','ASC')
            ->get();

        return view('pages.parents.index')->with(['parents'=>$parents,'userSites'=>$userSites]);
    }


    /**
    * Create a new parent in the system
    *
     **/
    public function create(Request $request){
        $student = Student::find($request->id);
        $stateOptions = ['NC'=>'North Carolina'];

        return view('pages.parents.create')->with(['student'=>$student,'stateOptions'=>$stateOptions]);
    }

    /**
     * Edit a resource in the system.
     */
    public function edit($id){
        $parents = Parents::find($id);
        $student = Student::find($parents->student_id);
        $stateOptions = ['NC'=>'North Carolina'];
        return view('pages.parents.edit')->with(['student'=>$student,'parent'=>$parents,'stateOptions'=>$stateOptions]);
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validator = \Validator::make($data, [
            'student_id' => 'required',
            'parent_first_name' => 'required|max:255',
            'parent_last_name' => 'required|max:255',
            'address_line_1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required'
        ]);

        //Validation
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $parent = Parents::create($data);

        //GO back to the student edit page; now that we have parent information.
        return redirect()->route('students.edit',[$parent->student_id])->with('flash_success','New Parent Added!');

    }

    public function update(Request $request,$id){
        $data = $request->all();

        $validator = \Validator::make($data, [
            'student_id' => 'required|max:255',
            'parent_first_name' => 'required|max:255',
            'parent_last_name' => 'required|max:255',
            'address_line_1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'phone_number'=>'required',
            'emailaddress'=>'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $parent = Parents::find($id);

        $parent->update($request->all());

        return redirect()->route('parents.index')->with('flash_success','Parent Updated!');
    }


    /**
     * Delete a parent in the system.
     */

    public function destroy($id)
    {
        $myParent = Parents::find($id);

        $myParent->delete();

        return back()->with('flash_success','Parent Deleted!');
    }

    /**
     * Additional methods.
     */
    public function addEventAttendance(Request $request){
        if(is_null($request->id)){
            return redirect()->back()->with(['flash_warning'=>'Please select an individual to add']);
        }

        $attendees  = array_unique($request->id);

        $selectedParentInformation = Parents::whereIn('id',$attendees)->select('id','parent_first_name','parent_last_name')->get();

        $eventOptions = Event::select(
            \DB::raw("CONCAT(date_format(event_start_date, ' %c/%e/%y'),' to ',date_format(event_end_date,'%c/%e/%y')) AS eventTimes"),'event_name','id'
        )->get();

        return view('pages.parents.eventadd')->with(['selectedParents'=>$selectedParentInformation,'eventOptions'=>$eventOptions]);
    }

    /**
     * Add event attendance for a Parent or Guardian.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addEventAttendanceComplete(Request $request){

        $MyEvent = Event::find($request->eventOptions);

        $attendees = json_decode($request->parents);

        if($MyEvent==NULL){
            return redirect()->route('parents.index')->with('flash_warning','Please select an event from dropdown, cannot add attendance.');
        }

        foreach($attendees as $parentAttendees){
                $MyEvent->parentAttendance()->attach($parentAttendees->id);
            }

        return redirect()->route('parents.index')->with('flash_success','Parent Attendance Added!');
    }

    /*
     * Remove a parental record from our attendance list.
     */
    public function removeEventAttendanceComplete($event,$id)
    {
        $myEvent = Event::find($event);
        $myEvent->parentAttendance()->detach($id);
        return redirect()->route('event.show',[$myEvent->id])->with('flash_success','Parent Attendance Removed!');
    }


}
