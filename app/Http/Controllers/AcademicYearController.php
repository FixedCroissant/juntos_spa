<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AcademicYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $student = Student::find($request->student);

        return view('pages.acad_year.create')->with(['student'=>$student]);
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
            'academic_year' => 'required|max:255',
            'stu_id'=>'required',
            'current'=>'required',
            'start_date'=>'required',
            'end_date'=>'required'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $formattedStart = Carbon::createFromFormat('m/d/Y', $request->start_date)->format('Y-m-d');
        $formattedEnd =  Carbon::createFromFormat('m/d/Y', $request->end_date)->format('Y-m-d');

        $academic_year = AcademicYear::create(['current'=>$request->current,'academic_year'=>$request->academic_year,'stu_id'=>$request->stu_id,'start_date'=>$formattedStart,'end_date'=>$formattedEnd]);

        return redirect()->route('students.edit',[$academic_year->stu_id])->with('flash_success','New Academic Year created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AcademicYear  $academicYear
     * @return \Illuminate\Http\Response
     */
    public function show(AcademicYear $academicYear)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AcademicYear  $academicYear
     * @return \Illuminate\Http\Response
     */
    public function edit(AcademicYear $academicYear)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AcademicYear  $academicYear
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AcademicYear $academicYear)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AcademicYear  $academicYear
     * @return \Illuminate\Http\Response
     */
    public function destroy(AcademicYear $academicYear)
    {
        //
    }
}
