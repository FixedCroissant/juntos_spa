<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    
    public function register(Request $request)
    {   

        $validatedData = $request->validate([
            'firstName' => 'required|max:55',
            'lastName' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required',
        ]);

        
        $validatedData['password'] = bcrypt($request->password);

       
       $user = User::create(
        [
                'name'=>$request->firstName,
                'email'=>$request->email, 
                'password'=>bcrypt($request->password),

        ]);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([ 'user' => $user, 'access_token' => $accessToken]);
    }

    public function login(Request $request)
    {

        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if (!auth()->attempt($loginData)) {
            return response(['message' => 'Invalid Credentials',200]);        
        }
     
        //To-Do -- Only access a token if one doesn't already exist.
        $accessToken = auth()->user()->createToken('accessToken')->accessToken;

        //Get roles associated with our user.
        $roles = auth()->user()->roles()->orderBy('name')->select('name','slug')->get();
 
        return response(['user' => auth()->user(),'roles'=>$roles, 'access_token' => $accessToken]);
    }

    public function logout(Request $request)
    {
     
        $myUser = User::find($request->user_id);    

        //Remove Access Token
        $accessToken = \DB::table('oauth_access_tokens')
       ->where('user_id',$request->user_id)       
        ->update([
            'revoked' => true
        ]);

        return response()->json(['status' => 200]);
    }

}
