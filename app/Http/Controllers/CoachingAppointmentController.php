<?php

namespace App\Http\Controllers;

use App\Models\CoachAppointment;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;


class CoachingAppointmentController extends Controller
{
    public function index()
    {

        $appointments = Student::select('id','student_first_name','student_last_name',
            DB::raw('CONCAT(student_first_name, " ", student_last_name) AS student_full_name'))->whereHas('coachAppointments',
            function($q){
            })->with('coachAppointments',
            function($q){
                $q->with('coach')->select(['id','appointment_date','created_at','student_id','user_id']);
            })->get();

        return view('pages.coaching_appointments.index')->with(['appointments'=>$appointments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //ToDo-Adjust those people that are in the dropdown based on the site the person is assigned to.
        $students = Student::select('id','student_first_name','student_last_name',
            DB::raw('CONCAT(student_first_name, " ", student_last_name) AS student_full_name'))
            ->orderBy('student_last_name','ASC')
            ->get();

        $user = Auth::user()->id;

        return view('pages.coaching_appointments.create')->with(['students'=>$students,'user_id'=>$user]);
    }

    public function store(Request $request){
        //Validate data on server side.
        $data = $request->all();

        $validator = \Validator::make($data, [
            'appointment_date' => 'required',
            'appointment_duration'=>'required',
            'method_of_contact' => 'required',
            'student_id' => 'required',
            'user_id'=>'required',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $coachAppointment = CoachAppointment::create($data);

        return redirect()->route('coaching.index')->with('flash_success','New Coaching Appointment Created!');
    }

    /**
     * Edit a new resource.
     */
    public function edit($id){
        $appointment = CoachAppointment::find($id);

        $students = Student::select('id','student_first_name','student_last_name',
            DB::raw('CONCAT(student_first_name, " ", student_last_name) AS student_full_name'))
            ->orderBy('student_last_name','ASC')
            ->get();

        $user = Auth::user()->id;

        return view('pages.coaching_appointments.edit')->with(['appointment'=>$appointment,'students'=>$students,'user_id'=>$user]);


    }

    /*
     * @param $studentID - studentID
     */
    public function show($studentID){
        //Get User.
        //To-Do Limit based on user.
        //$user = Auth::user()->id;

        $appointments = CoachAppointment::where('student_id',$studentID)->get();
        return view('pages.coaching_appointments.show')->with(['appointments'=>$appointments]);
    }

    public function update(Request $request,CoachAppointment $appointment, $id){
        $appointmentDate   = Carbon::createFromFormat('m/d/Y', $request->appointment_date)->format('Y-m-d');

        $appointment->update($request->all());
        $timeUpdate = CoachAppointment::find($id);
        $timeUpdate->update(['appointment_date'=>$appointmentDate]);
        $timeUpdate->save();

        return redirect()->route('coaching.index')->with('flash_success','Coach Appointment Updated');


    }

    /**
     * @param $id - Coaching Appointment ID
     *
     */
    public function editFollowUp($id)
    {
        $appointment = CoachAppointment::find($id);
        $student = Student::find($appointment->student_id);
        return view('pages.coaching_appointments.follow_up_appointment_edit')->with(['student'=>$student,'appointment'=>$appointment]);
    }

    /**
     * Update follow up appointment
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function followUpUpdated($id,Request $request){
        $appointment_follow_up_date   = Carbon::createFromFormat('m/d/Y', $request->appointment_follow_up_date)->format('Y-m-d');

        $data = $request->all();

        $validator = \Validator::make($data, [
            'appointment_follow_up_date' => 'required',
            'appointment_follow_up_method_of_contact'=>'required',
            'appointment_follow_up_duration' => 'required',
            'follow_up_notes' => 'required',
            'actions_needed'=>'required',
            'actions_made'=>'required',
            'results'=>'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $coachAppointment = CoachAppointment::find($id);
        $coachAppointment->update($request->all());
        $coachAppointment->update(['appointment_follow_up_date'=>$appointment_follow_up_date]);
        $coachAppointment->save();

        return redirect()->route('coaching.show',[$coachAppointment->student_id])->with('success_message','Follow Up Meeting Added!');
    }


    /**
     * Create the option of creating a new follow-up coaching appointment.
     * @param $id
     */
    public function createFollowUp($id)
    {
        $appointment = CoachAppointment::find($id);
        $student = Student::find($appointment->student_id);

        return view('pages.coaching_appointments.follow_up_appointment')->with(['student'=>$student,'appointment'=>$appointment]);
    }

    /***
     * Save follow up appointment.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function followUpComplete($id,Request $request){
        $data = $request->all();

        $validator = \Validator::make($data, [
            'appointment_follow_up_date' => 'required',
            'appointment_follow_up_method_of_contact'=>'required',
            'appointment_follow_up_duration' => 'required',
            'follow_up_notes' => 'required',
            'actions_needed'=>'required',
            'actions_made'=>'required',
            'results'=>'required'
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

        $coachAppointment = CoachAppointment::find($id);
        $coachAppointment->update($request->all());

        //PASS STUDENT ID.
        return redirect()->route('coaching.show',[$coachAppointment->student_id])->with('success_message','Follow Up Meeting Added!');
    }
}
