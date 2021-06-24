<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Events\CheckCoachingFollowUp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = "/";

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated() {

        $user = Auth::user();

        //Event to check past date of appointments.
        event(new CheckCoachingFollowUp($user));
    }

    /**
     * Handle logout requests.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(){
        //Log out of laravel authentication.
        Auth::logout();

        //Go to new logout notice page.
        return redirect('/googleSignout');
    }


    public function googleRedirect(){
           return Socialite::driver('google')
            ->scopes('openid','profile','email')
            ->with(['prompt'=>'select_account'])
            ->redirect();
    }

    /**
     *
     * To do we need to go to this point after javascript.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function googleCallback(Request $request){
        try {

        $user = Socialite::driver('google')->user();

        $existingUser = User::where('email', $user->email)->first();

            //Check for existing user in the system.
        if($existingUser)
        {
            //Event to check past date of appointments.
            event(new CheckCoachingFollowUp($existingUser));

            auth()->login($existingUser, true);
        }
        else
        {
                $newUser = new User;
                $newUser->name= $user->name;
                $newUser->account_type = "Google";
                $unityID = explode('@',$user->email);
                $newUser->unityid= $unityID[0];
                $newUser->email= $user->email;
                $newUser->password=bcrypt(Str::random(10));
                $newUser->save();

                $role = Role::find('4');

                $newUser->roles()->attach($role);

                //Log user In.
                auth()->login($newUser, true);
            }
        }

        catch (\Exception $e) {

        }

        //Redirect to main page.
        return redirect()->to('/');
    }

    /**
     * View Logout Page with more information on Logging out of
     * the application
     */
    public function viewLogoutPage(){
        return view('GoogleSignOut');
    }
}
