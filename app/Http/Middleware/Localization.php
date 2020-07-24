<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use App\Locale;

class Localization
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

        if(Session::has('locale'))
        {
            app()->setlocale(Session::get('locale'));
        }

//
//        $localeData = Locale::all();
//        $words = [];
//        foreach ($localeData as $data) {
//            $words[$data['key']] = $data[$locale];
//        }
//
//        View::share('words', $words);

        return $next($request);
    }
}
