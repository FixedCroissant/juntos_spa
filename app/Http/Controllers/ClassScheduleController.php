<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Schedule;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;



class ClassScheduleController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $student = Student::find($request->student);
        $acad_year = AcademicYear::find($request->acad_year);

        return view('pages.class_schedule.create')->with(['student'=>$student,'acad_year'=>$acad_year]);
    }

    /**
     * Store a newly created resource in  storage.
     * @param Request $request
     */
    public function store(Request $request){
       $data = $request->all();


       $validator = \Validator::make($data,[
           'period_id'=>'required',
           'semester_number'=>'required',
           'grade'=>'required',
           'schedule_type'=>'required',
           'class_name'=>'required',
           'teacher_name'=>'required',
           'room_number'=>'required',
           'academic_grade'=>'required'
       ]);

       if($validator->fails()){
           return back()->withErrors($validator)->withInput();
       }

       $schedule = schedule::create($data);

       return redirect()->route('schedule.show',[$schedule->student_id])->with('flash_success','Class Added to Schedule');


    }

    /**
     * Edit a new resource.
     */
    public function edit($id){

        $schedule = Schedule::find($id);
        $student = Student::find($schedule->student_id);
        $academicYearNotify = AcademicYear::find($schedule->acad_id);

        return view('pages.class_schedule.edit')->with(['academicYearNotify'=>$academicYearNotify,'student'=>$student,'schedule'=>$schedule]);
    }

    /**
     * Show all class schedules for a particular student.
     * @param $id
     *
     **/
    public function show($id){
        $student = Student::find($id);
        $acad_year = AcademicYear::where('stu_id',$student->id)->first();
        $scheduleInformation = Schedule::where('student_id',$student->id)->first();

        if($scheduleInformation==NULL){
            return redirect()->route('schedule.create',['student'=>$id,'acad_year'=>$acad_year])->with('flash_message','No schedule yet, please add first class.');

        }
        else{
            $schedule = AcademicYear::with('schedule')->where('stu_id',$student->id)->get();
        }

        return view('pages.class_schedule.show')->with(['student'=>$student,'schedule'=>$schedule]);
    }

    /**
     * @param Request $request
     * @param Schedule $schedule
     */
    public function update(Request $request, Schedule $schedule){
        $schedule->update($request->all());
       return redirect()->route('schedule.show',[$schedule->student_id])->with('flash_success','Updated Class');
    }
}
