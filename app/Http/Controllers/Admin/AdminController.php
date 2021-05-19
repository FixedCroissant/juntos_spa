<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\States;
use App\Models\County;
use App\Models\Sites;
use App\Models\Settings;

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
            $roles = Role::all();

            return view('pages.admin.roles.index')->with(['roles'=>$roles]);
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
        $assignmentDetails = Sites::find($request->site_picked);

        //User list (ToDo-Narrow down to just coordinators)
        $userList = User::all();

        return view('pages.admin.settings.coordinator_assignment.assign')->with(['userList'=>$userList,'assignmentDetails'=>$assignmentDetails,'assignmentArea'=>$assignmentArea,'states'=>$states,'countyOptions'=>$countyOptions->get(),'siteOptions'=>$siteOptions->get()]);
    }

    /**
     *
     */
    public function assignedUser(Request $request){
        $user = User::find($request->assignmentUser);
        $user->studentAccess()->attach($request->assignmentSite);

        return back()->with('flash_success','Successfully Added Access');

    }

    public function assignmentIndex(){
        $users = User::has('studentAccess')->get();

        return view('pages.admin.settings.coordinator_assignment.index')->with(['users'=>$users]);
    }

    /*
     * Remove access of a particular site from a user.
     */
    public function removeAccess($userID,$siteID){
        //Remove access
        $user = User::find($userID);
        $user->studentAccess()->detach($siteID);


        return back()->with('flash_success','Successfully Removed Access');
    }

    //Front Page and Days to Look.
    public function settingsMainFront(){

        $settings = Settings::find(1);

        return view('pages.admin.settings.application_settings.edit')->with(['settings'=>$settings]);
    }

    public function updateMainSettings(Request $request){

        $settings = Settings::find(1);
        $settings->coordinator_follow_up_meeting_past_due = $request->coordinator_follow_up_meeting_past_due;
        $settings->front_page_text = $request->front_page_text;
        $settings->save();

        return redirect()->back()->with(['flash_success'=>'Main Settings Updated']);
    }
}
