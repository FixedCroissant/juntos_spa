<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Redirect;

class CheckAdmin
{
    /**
     * Check User Role
     *
     * @param \Illuminate\Http\Request $request
     * @return string|null
     */
    public function handle($request, Closure $next)
    {
        //Check to see if the user has an Admin role in the application.
        if(Auth::user()->hasRole('Admin')){
            return $next($request);
        }
        else
        {
            return Redirect::to('/')->with(['flash_warning'=>'You do not have access to this area.']);
        }
    }
}
