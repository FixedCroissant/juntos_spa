<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;



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


}
