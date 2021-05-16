<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Exports\StudentsExport;
use App\Exports\VolunteersExport;



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
        if($type=="student"){
            return view('pages.reports.students.index');
        }
        if($type=="volunteers"){
            return view('pages.reports.volunteers.index');
        }
    }


    //Download reports -- Student
    public function studentExport()
    {
        return \Excel::download(new StudentsExport, 'student_list.xlsx');
    }

    //Download report -- Volunteers
    public function volunteerExport()
    {
        return \Excel::download(new VolunteersExport, 'volunteer_list.xlsx');
    }

}
