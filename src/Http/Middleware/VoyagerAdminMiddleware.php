<?php

namespace CHG\Voyager\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use CHG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Session;

class VoyagerAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::id()) {
            $user = Voyager::model('User')::find('admin');

            return $user->hasPermission('browse_admin') ? $next($request) : redirect('/');
        }

        $urlLogin = route('voyager.login');

        return redirect()->guest($urlLogin);
    }
}
