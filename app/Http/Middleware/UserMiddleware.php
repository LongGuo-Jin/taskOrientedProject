<?php

namespace App\Http\Middleware;
use App\Model\Person;
use Closure;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user_id = auth()->user()->id;
        $person =  Person::where('userID',$user_id)->get()->first();
        $personID = $person->ID;
        $login_role_id = $person->roleID;
        if ($login_role_id != 1) {
            abort(403, "Whoops , you must be an admin to view this page");
        }
        return $next($request);
    }
}
