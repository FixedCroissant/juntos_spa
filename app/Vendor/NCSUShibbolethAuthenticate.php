<?php

namespace App\Vendor;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use NCSU\Auth\Adapter\ShibAuthAdapter;
use NCSU\Auth\AuthService;
use NCSU\Auth\Http\Request;

use App\Models\User;
use App\Models\Role;
use Carbon\Carbon;
use App\Events\CheckCoachingFollowUp;
use App\Events\NotifyJuntos;


class NCSUShibbolethAuthenticate
{
    private $authService;

    public function __construct()
    {
        $this->authService = new AuthService(new ShibAuthAdapter(Request::createFromGlobals()));
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     * @throws AuthenticationException
     */
    public function handle($request, Closure $next)
    {

        if (Auth::guest()) {

            $response = $this->authService->authenticate();

            //Check if valid response.
            if (!$response->isValid()) {
                throw new AuthenticationException(implode(' ', $response->getMessages()));
            }

            $identity = $response->getIdentity();

            $user = $this->findOrCreateUser($identity);

            Auth::login($user);

            //Coaching notice check.
           event(new CheckCoachingFollowUp($user));
        }

        return $next($request);
    }

    /**
     * Return user if exists; create and return if doesn't
     *
     * @param $shibbolethUser - unityid.
     * @return User
     */
    private function findOrCreateUser($shibbolethUser)
    {
        $ShibbolethUserFirstName = $_SERVER['SHIB_GIVENNAME'];
        $ShibbolethUserLastName = $_SERVER['SHIB_SN'];
        $ShibbolethEMailAddress = $_SERVER['SHIB_MAIL'];

        if ($authUser = User::where('email', $ShibbolethEMailAddress)->first()) {
            return $authUser;
        }

        else
        {
                    $user = User::create([
                                    'name'=>$ShibbolethUserFirstName. " ". $ShibbolethUserLastName,
                                    'account_type'=>'Shibboleth',
                                    'unityid' => $shibbolethUser,
                                    'email' => $ShibbolethEMailAddress,
                                    'password' => bcrypt(Str::random(10)),
                                    'created_at' => Carbon::now(),
                                    'updated_at' => Carbon::now()
                            ]);

                    $role = Role::find('4');

                    $user->roles()
                        ->attach($role);

                    //Notify JUNTOS of new User.
                    event(new NotifyJuntos($user));

            return $user;
        }
    }

}
