<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAdminAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::guard($guard)->check()) 
        {
            if ($request->ajax()) 
            { 
                return response([
                    'error' => 'unauthorized',
                    'error_description' => 'Failed authentication.',
                    'data' => [],
                ], 401);
            } 
            else 
            {
                return redirect(meezzaa_admin_prefix);
            }

        }
        return $next($request);
    }
}
