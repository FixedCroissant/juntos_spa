<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Events\CheckCoachingFollowUp;
use Illuminate\Support\Facades\Auth;

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

        //Redirect to standard Shib out page.
        $ncsuLogoutPage = 'https://shib.ncsu.edu/idp/profile/Logout';

        return redirect($ncsuLogoutPage);
    }
}
