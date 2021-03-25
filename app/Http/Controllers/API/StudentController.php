<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;

use App\Models\Student;
use App\Models\Event;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$students = Student::with(['school'=>function($query){
            $query->select('school_name');
        }
        ,'parent'

        
        
        
        ,'attendance'])
        ->get();*/

        //convert to db builder
        $students = \DB::table('students')
        //->join('parents', 'students.id', '=', 'parents.student_id')
        ->leftJoin('schools', 'students.school_id', '=', 'schools.id')
        //->leftJoin('event_attendance','students.id','=','event_attendance.student_id')
        ->select('students.id',\DB::raw('CONCAT(students.student_first_name, " ", students.student_last_name) AS student_full_name'),'schools.school_name','schools.school_county','students.student_first_name', 'students.student_last_name','students.address_line_1','students.coordinator')
        ->get();


        return response([ 'students' => $students, 'message' => 'Retrieved successfully'], 200);
   
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
             'zip' => 'required'
         ]);

        //Validation
         if($validator->fails()){
             return response(['error' => $validator->errors(), 'Validation Error']);
         }

        $student = student::create($data);

        return response([ 'student' => new StudentResource($student), 'message' => 'Created Student','status'=>200], 200);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //Get student with parent information.
        //$student

        $eventInformation = $student->attendance;

      
        return response([ 'student' => new StudentResource($student),'attendance'=>new StudentResource($eventInformation),'parent'=>new StudentResource($student->parent), 'message' => 'Retrieved successfully'], 200);

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

        return response([ 'student' => new StudentResource($student), 'message' => 'Retrieved successfully'], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CEO  $CEO
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return response(['message' => 'Student Deleted'],200);
    }
}
