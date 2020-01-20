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
        if (Session::get('id')) {
            $rights = Session::get('rights');

            if (in_array("CSUSR", $rights) || in_array("CSSUP", $rights) || in_array("SALES_USR", $rights) || in_array("CSMGR", $rights) || in_array("SUPER", $rights)){
                return $next($request);
            }

            return redirect('/');
        }

        $urlLogin = route('voyager.login');

        return redirect()->guest($urlLogin);
    }
}
