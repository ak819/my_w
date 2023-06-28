<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {    
        $locale = Session::get('locale');
        if (null === $locale) {
        if($request->segment(1) && in_array($request->segment(1),config('app.available_locales')))
        {
            $locale=$request->segment(1);
            session()->put('locale',$locale); 
        }else{
            $locale = config('app.fallback_locale');
        }
        }elseif($locale!==$request->segment(1) &&  in_array($request->segment(1),config('app.available_locales')))
        {
            $locale=$request->segment(1);
            session()->put('locale',$locale); 
        }
        
        App::setLocale($locale);
        return $next($request);
    }
}
