<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;

use App\Models\Student;
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
        //$students = Student::with('school')->get();

        //convert to db builder
        $student = \DB::table('students')
        ->join('parents', 'students.id', '=', 'parents.student_id')
        ->join('schools', 'students.school_id', '=', 'schools.id')
        ->select('schools.*', 'students.student_first_name', 'students.student_last_name','students.address_line_1','students.coordinator')
        ->get();


        return response([ 'students' => $student, 'message' => 'Retrieved successfully'], 200);
   
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

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'year' => 'required|max:255',
            'company_headquarters' => 'required|max:255',
            'what_company_does' => 'required'
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $ceo = CEO::create($data);

        return response([ 'ceo' => new CEOResource($ceo), 'message' => 'Created successfully'], 200);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CEO  $CEO
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //Get student with parent information.
        //$student

        return response([ 'student' => new StudentResource($student),'parent'=>new StudentResource($student->parent), 'message' => 'Retrieved successfully'], 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CEO  $CEO
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $STUDENT)
    {
        $ceo->update($request->all());

        return response([ 'ceo' => new CEOResource($ceo), 'message' => 'Retrieved successfully'], 200);

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
