<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentResource;

use App\Models\Student;
use App\Models\Event;
use App\Models\User;
use  App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //TODO Get the ID of the currently logged in user from Vue.


        //Use students and coordinator information.
        //See setup access for User.
        //$userAccess = User::find(1)->studentAccess()->select('site_name')->get();

        $loggedInUser = auth()->user();

        $userAccess = $loggedInUser;
        //Item to Narrow.
        $userSites=[];

        //Get Access.
        foreach($userAccess->studentAccess as $siteAccess){
            //echo $siteAccess;
            //echo $siteAccess->pivot->site_id;
            //echo "<br/>";
            $userSites[]=$siteAccess->pivot->site_id;
        }

        //convert to db builder
        $students = \DB::table('students')
            //Using Sites instead.
            ->leftJoin('sites', 'students.site_id', '=', 'sites.id')
            ->select('students.id','students.site_id','students.phone_number','students.student_id',\DB::raw('CONCAT(students.student_first_name, " ", students.student_last_name) AS student_full_name'),'sites.site_name','students.student_first_name', 'students.student_last_name','students.address_line_1','students.email_address')
            ->whereIn('site_id', $userSites)
            ->get();

        return view('pages.students.index')->with(['students'=>$students,'userSites'=>$userSites]);
    }

    public function create(){
             $stateOptions = ['NC'=>'North Carolina'];
             $gradeOptions = ['8'=>'8th Grade','9'=>'9th Grade','10'=>'10th Grade','11'=>'11th Grade','12'=>'12th Grade'];
             $user = Auth::user();
             $siteOption = $user->studentAccess()->select('sites.id','site_name')->get();
             return view('pages.students.create')->with(['siteOption'=>$siteOption,'gradeOptions'=>$gradeOptions,'stateOptions'=>$stateOptions]);
    }

    /**
     * Edit a resource in the system.
     */
    public function edit($id){
        $student = Student::find($id);
        $stateOptions = ['NC'=>'North Carolina'];
        $gradeOptions = ['8'=>'8th Grade','9'=>'9th Grade','10'=>'10th Grade','11'=>'11th Grade','12'=>'12th Grade'];
        $user = Auth::user();
        $siteOption = $user->studentAccess()->select('sites.id','site_name')->get();
        $academicYear = AcademicYear::where('stu_id',$student->id)->select('academic_year','id')->get();
        return view('pages.students.edit')->with(['academicYear'=>$academicYear,'siteOption'=>$siteOption,'student'=>$student,'gradeOptions'=>$gradeOptions,'stateOptions'=>$stateOptions]);
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
            'student_id' => 'required|max:255',
            'student_first_name' => 'required|max:255',
            'student_last_name' => 'required|max:255',
            'address_line_1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'grade'=>'required',
            'site_id'=>'required'
        ]);

        //Validation
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $student = student::create($data);

        //ToDo--Go back to view.
        return redirect()->route('students.edit',[$student->id])->with('flash_success','New Student Added, feel free to create a parent!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {

        return view('pages.students.show');

        //Get student with parent information.
        //$student = Student::find($student);

        //$eventInformation = $student->attendance;


        //return response([ 'student' => new StudentResource($student),'attendance'=>new StudentResource($eventInformation),'parent'=>new StudentResource($student->parent), 'message' => 'Retrieved successfully'], 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //Update our student with address information.
        $student->update($request->all());

        return redirect()->route('students.index')->with('flash_success','Student Updated!');

    }


    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();


        return back()->with('flash_success','Student Deleted!');
    }


    /**
     * Additional methods.
     */
    public function addEventAttendance(Request $request){
        // what do we have in the request?
        //return dd($request->id);

        //Remove our duplicates.
        $attendees  = array_unique($request->id);

        $selectedStudentInformation = Student::whereIn('id',$attendees)->select('id','student_first_name','student_last_name')->get();

        $eventOptions = Event::pluck('event_name','id');


        return view('pages.students.eventadd')->with(['selectedStudents'=>$selectedStudentInformation,'eventOptions'=>$eventOptions]);
    }

    /**
     *
     */
    public function addEventAttendnaceComplete(Request $request){

        $MyEvent = Event::find($request->eventOptions);

        $attendees = json_decode($request->students);

        if($MyEvent==NULL){
            return redirect()->route('students.index')->with('flash_warning','Please select an event from dropdown, cannot add attendance.');
        }

        if($request->type=="student"){
            foreach($attendees as $studentAttendees){
                $MyEvent->attendance()->attach($studentAttendees->id);
            }
        }

        return redirect()->route('students.index')->with('flash_success','Student Attendance Added!');
    }
}
