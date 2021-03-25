<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Models\Schedule;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Resources\ScheduleResource;



class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {  
        //Find our semester year
        //ToDo-- fix this so that it isn't hardcoded.      
        $semester_year="All Years";

        //Group by Semester at first, but allow the implementation of a year filter to be added in.
        //Filter example
        //$schedules = Schedule::where('student_id',$id)->where('semester_year',$semester_year)->get()->groupBy('semester_number');

        //No filter.
        $schedules = Schedule::where('student_id',$id)->get()->groupBy('semester_year','semester_number');

        //Student Information
        $studentInfo = Student::where('id',$id)->select('student_first_name','student_last_name','id')->first();

        return response(['year'=>$semester_year, 'schedules' => new ScheduleResource($schedules),'studentInformation'=>$studentInfo,'message' => 'Schedule Retrieved','status'=>200], 200);
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
             'student_id' => 'required',
             'period_id' => 'required',
             'semester_year' => 'required',
             'semester_number'=>'required',           
             'grade'=>'required',
         ]);
 
        //Validation
         if($validator->fails()){
             return response(['error' => $validator->errors(), 'Validation Error']);
         }
 
        $newItem = Schedule::create($data);
 
        return response([ 'schedule' => new ScheduleResource($newItem), 'message' => 'Created new class successfully','status'=>200], 200);
    }
   
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Find class 
        $class = Schedule::find($id);
        //Update our class with new information.
        $class->update($request->all());
         return response([ 'class' => new ScheduleResource($class), 'message' => 'Updated Class successfully'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ID
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule, $id)
    {
        $mySchedule = Schedule::find($id);
        
        $mySchedule->delete();

        return response(['message' => 'Class Deleted'],200);
    }
}
