<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use App\Models\Currency;


class Currencyset
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
        $currency = Session::get('currency');
        if (null === $currency) {
            $Currency=Currency::get()->first();
            $currency=[$Currency->Name,$Currency->Value,$Currency->flag];
        }else{
            $Currency=Currency::where('Name',$currency[0])->get()->first();
            $currency=[$Currency->Name,$Currency->Value,$Currency->flag];
        }
        session()->put('currency',$currency);
        return $next($request);
    }
}
