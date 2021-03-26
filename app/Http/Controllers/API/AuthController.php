<?php

namespace App\Http\Controllers\API;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class AuthController extends Controller
{
    
    public function register(Request $request)
    {   
        $data = $request->all();
        
         $validator = \Validator::make($data, [
            'firstName' => 'required|max:55',
            'lastName' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'password' => 'required',
         ]);

         //Provide Validation Errors
         if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }
        
        $validatedData['password'] = bcrypt($request->password);
       
       $user = User::create(
        [
                'name'=>$request->firstName." " . $request->lastName,
                'email'=>$request->email, 
                'password'=>bcrypt($request->password),

        ]);

      $role = Role::find('4');
      $user->roles()->attach($role);

        return response(['user' => $user]);
    }

    public function login(Request $request)
    {

        $loginData = $request->all();

        $validator = \Validator::make($loginData, [
            'email' => 'email|required',
            'password' => 'required'
         ]);
        
        //Provide Validation Errors
        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        //Atempt login.
        $credentials = $request->only('email', 'password');

        if (!auth()->attempt($credentials)) {
            return response(['message' => 'Invalid Credentials',200]);        
        }
     
        //Get token.
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

    /**
     * Google Redirect
     */
    public function googleRedirect(){

        return [
            'url' => Socialite::driver('google')->stateless()->with(['prompt'=>'select_account'])->redirect()->getTargetUrl(),
        ];
}    

/**
 * Google Callback
 * @param Request
 */
public function googleCallback(Request $request){
    //Get Google user through Socialite.
    $provider = 'google';
    $google_user = Socialite::driver($provider)->stateless()->user();

    //Create user using separate method.
    $user = $this->findOrCreate($google_user->email,$google_user->user['given_name'],$google_user->user['family_name']);

    // Login the created user
    \Auth::login($user, true);

    //Get roles associated with our user.
    $roles = auth()->user()->roles()->orderBy('name')->select('name','slug')->get();

    //Get Access Token based on user.
    $accessToken = $user->createToken('authToken')->accessToken;

        return view('oauth/callback', [
            'token' => $accessToken,
            'user' => auth()->user(),
            'roles'=>$roles,
        ]);

}
//End Google


/**
 * @param email address
 */
private function findOrCreate($email, $firstName, $lastName){

   //Find user through our user class.
   if ($authUser = User::where('email', $email)->first()) 
   {           
        return $authUser;
    }
    else{
    $user = User::create(
    [       'email'=>$email,
            'name'=>$firstName . " " . $lastName,
            'password'=>bcrypt(str_random(9)),   
    ]);
    
    //Apply roles.  
    $role = Role::find('4');
    $user->roles()->attach($role);

    return $user;

    
}




  

}


}
