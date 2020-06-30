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
        $user_id = auth()->user()->roleID;

        if ($user_id != 1) {
            abort(403, "Whoops , you must be an admin to view this page");
        }
        return $next($request);
    }
}
