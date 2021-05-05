<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\States;
use App\Models\County;
use App\Models\Sites;

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
        return view('pages.admin.settings.index');
    }
    /*
     * Assign sites to a coordinator.
     */
    public function settingsCoordinatorAssignment(Request $request){
        $states = States::pluck('state_name','id');
        $countyOptions = County::query();
        $countyOptions->where('state_id',$request->state_picked);
        $siteOptions = Sites::query();
        $siteOptions->where('county_id',$request->county_picked);
        $assignmentArea = $request->site_picked;
        $assignmentInformation = $request->has('site_picked');
        $assignmentDetails = Sites::find($assignmentInformation);

        //User list (ToDo-Narrow down to just coordinators)
        $userList = User::all();

        return view('pages.admin.settings.coordinator_assignment.index')->with(['userList'=>$userList,'assignmentDetails'=>$assignmentDetails,'assignmentArea'=>$assignmentArea,'states'=>$states,'countyOptions'=>$countyOptions->get(),'siteOptions'=>$siteOptions->get()]);
    }

    /**
     *
     */
    public function assignedUser(Request $request){

        $userToAssign = $request->assignmentUser;


    }
}
