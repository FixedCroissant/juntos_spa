<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Exports\StudentsExport;



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
        return view('pages.reports.students.index');
    }

    //Download reports -- Student
    public function studentExport()
    {
        return \Excel::download(new StudentsExport, 'student_list.xlsx');
    }

}
