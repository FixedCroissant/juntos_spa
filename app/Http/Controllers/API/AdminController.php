<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Role;

class AdminController extends Controller
{
    /**
     * Display user page, should possbily be just index()
     */
    public function users(Request $request)
    {
        $users= User::with('roles')->get();
       
        return response([ 'users' => $users,'message' => 'Retrieved Users','status'=>200], 200);
    }

    /*
     * Edit Use Page
     */
    public function edit(Request $request)
    {
        $user= User::select('id','created_at','name','email')->where('id',$request->id)->first();
        //Get Roles of our User.
        $userRole=User::find($request->id)->roles;

        $rolesOfSearchedUser=[];
        //Use to isolate other roles in our list.
         foreach ($userRole as $role) {
            $rolesOfSearchedUser[]=$role->pivot->role_id;
         }

        
        //Temporarily add information to use on the front end.
        $roleExists="checked";
        $itemStatus=true;

        //Add Flag for JSON
        $userRole->map(function($roleExists) use ($itemStatus) {
            $roleExists['checked'] = $itemStatus;
            return $roleExists;
         });

        //Roles that don't exist to our user.      
        $roles = Role::select('id','name','slug')        
        ->orderBy('id','ASC')
        //working but hard coded.
        //->whereNotIn('id', [1, 2])
        ->whereNotIn('id', $rolesOfSearchedUser)
         ->get();


         //Add more
         //Temporarily add information to use on the front end.
        $roleExists="checked";
        $itemStatus=false;

        //temp
        $roles->map(function($roleExists) use ($itemStatus) {
            $roleExists['checked'] = $itemStatus;
            return $roleExists;
         });       
         //end add more.

         //Merge Two Results.
         $mainCollection = collect($userRole)->merge($roles);

       
        return response([ 'user' => $user,'userRole'=>$userRole,'roles'=>$roles,'rolesToSearch'=>$rolesOfSearchedUser,'mainCollection'=>$mainCollection,'message' => 'Retrieved User','status'=>200], 200);
    }

    /**
     * Update roles in the system.
     */
    public function role(Request $request){
        //Find User
        $user = User::find($request->user['id']);
        $user->name = $request->user['name'];
        $user->email = $request->user['email'];
        $user->save();

        //Adjust roles.
        //Will be an array.
        $roles = $request->roles;

        $myRolesPassed = [];

        //Find if role exists
        $userRoles = User::find($request->user['id']);
        //$userRoles->roles()->whereIn('id',[$myRoles['id']])

        $myRolestoAttach=[];

        foreach($roles as $myRoles){
            $myRolesPassed[]=$myRoles;
        
            
        //Update Roles in the system.
        if($myRoles['checked']){

                $myRolestoAttach[]=$myRoles['id'];
        }
            //Finally add roles.
            $user->roles()->detach();
            //Update new roles.
            $user->roles()->attach($myRolestoAttach);

        }

        return response(['user'=>$user,'roles'=>$myRolesPassed,'message' => 'Updated User','status'=>200], 200);
    }

    /**
     * Get all roles in the system.
     */
     
     public function getRoles(Request $request){
         //Get all Roles
         $roles = Role::select('id','created_at','name','slug')->get();

        return response(['roles'=>$roles,'message' => 'Roles Retrieved','status'=>200], 200);
     }

     /**
      * Update roles in the System.
      */
      public function updateRoles(Request $request){
        //Get all Roles
        $roles = Role::select('id','name','slug')->get();

       return response(['roles'=>$roles,'message' => 'Role Updated','status'=>200], 200);
    }
}
