<?php

namespace EVOS\Http\Middleware;

use Auth;
use Closure;

class AdminMiddleware
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
        if(!Auth::user() || !Auth::user()->isAdmin) {
            return redirect(action('CategoryController@index'))
                ->withErrors(['Keine Berechtigung!']);
        }
        return $next($request);
    }
}
