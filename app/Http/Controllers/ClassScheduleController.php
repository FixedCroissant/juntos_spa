<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;



class ClassScheduleController extends Controller
{
    public function index()
    {


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    public function store(Request $request){

    }

    /**
     * Edit a new resource.
     */
    public function edit($id){

    }

    //Additional methods

    /*
     * @param $studentID - studentID
     */
    public function seeAllStudentsAppointments($studentID){

    }

}
