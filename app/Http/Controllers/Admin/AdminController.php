<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    //Main index page on the backend.
    public function index(){
        $users = User::all();

        //Default page.
        return view('pages.admin.index')->with(['users'=>$users]);

   }

    //Roles
      public function roleIndex(){
            return view('pages.admin.roles.index');
      }

    /*
      * get settings page
      */
    public function settingsList(){
        // go to our settings page.
        return view('pages.admin.settings.index');
    }
}
