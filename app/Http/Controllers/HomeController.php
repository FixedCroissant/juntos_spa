<?php

namespace App\Http\Controllers;
use App\Models\Settings;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $frontPageText= Settings::find(1);

        return view('dashboard')->with(['frontpagetext'=>$frontPageText]);
    }
}
