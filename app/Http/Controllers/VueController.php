<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VueController extends Controller
{
    //Index

    public function index()
    {
        return view('vue');
    }
}
