<?php

namespace App\Http\Controllers\API;

use App\Models\CoachAppointment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CoachAppointmentResource;
use DB;

use App\Models\Student;

class CoachAppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //ToDo - Get only people that have the coordinator role.
        //Get all appointments, with student information.
           $appointments = Student::select('id','student_first_name','student_last_name',
           DB::raw('CONCAT(student_first_name, " ", student_last_name) AS student_full_name'))->whereHas('coachAppointments',
           function($q){
                            })->with('coachAppointments',
                    function($q){
                             $q->with('coach')->select(['id','appointment_date','created_at','student_id','user_id']);
                    })->get();


        return response(['appointments'=>$appointments,'message' => 'Coaching Appointments Retrieved','status'=>200], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Get students with X location, based on coaches/coordinators appointment.
        //for now, list all students that will be eventually filtered down.
        //To-Do LIMIT RESULTS IN THE DROPDOWN.

        $students = Student::select('id','student_first_name','student_last_name',
        DB::raw('CONCAT(student_first_name, " ", student_last_name) AS student_full_name'))
        ->orderBy('student_last_name','ASC')
        ->get();

        return response(['students'=>$students,'message' => 'Roles Retrieved','status'=>200], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate data on server side.
        $data = $request->all();
        
        $validator = \Validator::make($data, [
            'appointment_date' => 'required',
            'method_of_contact' => 'required',
            'student_id' => 'required',
            'user_id'=>'required',           
        ]);

       //Validation
        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

       $coachAppointment = CoachAppointment::create($data);

       return response([ 'appointment' => new CoachAppointmentResource($coachAppointment), 'message' => 'Created Appointment Successfully','status'=>200], 200);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CoachAppointment  $coachAppointment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $appointment = CoachAppointment::where('id','=',$id)
        ->select(
            'id',
            'user_id',
            'student_id',
            'method_of_contact',
            'actions_needed',
            'appointment_date',
            'appointment_follow_up_date',
            'Additional_Information',
            'StudentCounselor',
            'EducationalGoals',
            'follow_up_notes',
            'actions_made',
            'results'
        )->first();

        //Get appointment information
        return response(['appointment'=>$appointment,'message' => 'Appointment Retrieved','status'=>200], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CoachAppointment  $coachAppointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Find appointment 
        $appointment = CoachAppointment::find($id);

        //Update our coaching appointment
        //ToDo check for error when updating.
        $appointment = CoachAppointment::find($id);
        
        //Update our Appointment with new information.
        $appointment->update($request->all());

         return response([ 'appointment' => new CoachAppointmentResource($appointment), 'message' => 'Updated Appointment successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CoachAppointment  $coachAppointment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $coachAppointment = CoachAppointment::find($id);

        $coachAppointment->delete();

        return response(['message' => 'Coach Appointment Deleted'],200);
    }
}
