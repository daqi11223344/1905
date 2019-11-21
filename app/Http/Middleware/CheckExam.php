<?php

namespace App\Http\Middleware;

use Closure;

class CheckExam
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
        $admin = session('admin');
        // dd($admin);
        if(!$admin){
            return redirect('/add/reg');
        }
        return $next($request);
    }
}
