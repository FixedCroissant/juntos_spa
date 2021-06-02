<?php

namespace App\Http\Controllers;

use App\Models\Sites;
use App\Models\Student;
use Illuminate\Http\Request;
use DB;
use App\Exports\StudentsExport;
use App\Exports\VolunteersExport;
use App\Exports\PostSurveyIncompleteExport;
use App\Exports\AllEventAllAttendanceExport;



class ReportingController extends Controller
{
    public function index()
    {
        return view('pages.reports.index');
    }


    /**
     * @param Request $request
     */
    public function show(Request $request,$type){
        if($type=="students"){
            //Get all sites
            $sites = Sites::select('id','site_name')->get();
            //Student Provided Counties
            $countyFilter = Student::select('county')->distinct()->get();

            return view('pages.reports.students.index')->with(['sites'=>$sites,'countyStudentInput'=>$countyFilter]);
        }
        if($type=="volunteers"){
            return view('pages.reports.volunteers.index');
        }
        if($type=="post_survey_incomplete"){
            return view('pages.reports.post_survey_incomplete.index');
        }
    }


    //Download reports -- Student
    public function studentExport(Request $request)
    {
        return \Excel::download(new StudentsExport($request->get('counties'),$request->get('site')), 'student_list.xlsx');
    }

    //Download report -- Volunteers
    public function volunteerExport()
    {
        return \Excel::download(new VolunteersExport, 'volunteer_list.xlsx');
    }

    public function postSurveyIncompleteExport(){
        return \Excel::download(new PostSurveyIncompleteExport,'post_survey_incomplete_list.xlsx');
    }
    //Admin report.
    public function allEventsAllAttendanceStudentParentExport(){
        return \Excel::download(new AllEventAllAttendanceExport,'all_events_all_attendance.xlsx');
    }

}
