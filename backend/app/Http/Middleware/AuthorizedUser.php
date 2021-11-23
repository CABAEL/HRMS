<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class AuthorizedUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            if($request->user()->role == 'admin'){

                return redirect('/admin/home');
                
            }
            if($request->user()->role == 'hr_head'){

                return redirect('/hr_head/home');

            }
            else{
                
                return abort('401');
            }
        }
        else{
            return response()->view('login');
        }

    }
}
