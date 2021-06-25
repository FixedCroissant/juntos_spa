<?php

namespace App\Http\Controllers;

use App\Models\Sites;
use App\Models\Student;
use App\Models\Volunteer;
use Illuminate\Http\Request;
use DB;
use App\Exports\StudentsExport;
use App\Exports\VolunteersExport;
use App\Exports\VolunteersAdminExport;
use App\Exports\PostSurveyIncompleteExport;
use App\Exports\AllEventsAdminExport;
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
            $sites = Sites::select('id','site_name')->orderBy('site_name','ASC')->get();
            //Student Provided Counties
            $countyFilter = Student::select('county')->orderBy('county','ASC')->distinct()->get();

            return view('pages.reports.students.index')->with(['sites'=>$sites,'countyStudentInput'=>$countyFilter]);
        }
        //For admin, show all events in excel.
        if($type=="all_events_admin"){
            $sites = Sites::select('id','site_name')->orderBy('site_name','ASC')->get();

            return view('pages.reports.events.index')->with(['sites'=>$sites]);
        }
        //Admin report.
        if($type=="all_volunteers_admin"){
            $sites = Sites::select('id','site_name')->orderBy('site_name','ASC')->get();
            $countyFilter = Volunteer::select('county')->orderBy('county','ASC')->distinct()->get();
            return view('pages.reports.volunteers.admin.index')->with(['sites'=>$sites,'countyStudentInput'=>$countyFilter]);
        }

        if($type=="volunteers"){
            $sites = Sites::select('id','site_name')->orderBy('site_name','ASC')->get();
            $countyFilter = Volunteer::select('county')->orderBy('county','ASC')->distinct()->get();
            return view('pages.reports.volunteers.index')->with(['sites'=>$sites,'countyStudentInput'=>$countyFilter]);
        }
        if($type=="post_survey_incomplete"){
            return view('pages.reports.post_survey_incomplete.index');
        }
    }


    //Download reports -- Student
    public function studentExport(Request $request)
    {
        return \Excel::download(new StudentsExport($request->get('counties'),$request->get('site'),$request->get('grade')), 'student_list.xlsx');
    }

    //Download report -- Volunteers
    public function volunteerExport(Request $request)
    {
        return \Excel::download(new VolunteersExport($request->get('counties'),$request->get('site')), 'volunteer_list.xlsx');
    }
    //Admin Report - Volunteers
    public function volunteerAdminExport(Request $request){
        return \Excel::download(new VolunteersAdminExport($request->get('counties'),$request->get('site')), 'admin_volunteer_list.xlsx');
    }

    public function postSurveyIncompleteExport(){
        return \Excel::download(new PostSurveyIncompleteExport,'post_survey_incomplete_list.xlsx');
    }

    //Admin report
    public function allEventsAdmin (Request $request){
     return \Excel::download(new AllEventsAdminExport($request->get('site'),$request->get('event_type')), 'admin_event_list.xlsx');
    }
    //Admin report.
    public function allEventsAllAttendanceStudentParentExport(){
        return \Excel::download(new AllEventAllAttendanceExport,'all_events_all_attendance.xlsx');
    }

}
