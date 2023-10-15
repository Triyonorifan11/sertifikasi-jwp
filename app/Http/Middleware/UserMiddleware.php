<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // check if category is url allowed and a
        $role = $request->user()->role;
        // check url is start by /category
        if (strpos($request->url(), url('/category')) === 0 && !$role->master_category) {
            return redirect()->route('no-access');
        }
        // check url is start by /unit
        if (strpos($request->url(), url('/unit')) === 0 && !$role->master_unit) {
            return redirect()->route('no-access');
        }
        // check url is start by /customer
        if (strpos($request->url(), url('/customer')) === 0 && !$role->master_customer) {
            return redirect()->route('no-access');
        }
        // check url is start by /supplier
        if (strpos($request->url(), url('/supplier')) === 0 && !$role->master_supplier) {
            return redirect()->route('no-access');
        }
        // check url is start by /roles
        if (strpos($request->url(), url('/roles')) === 0 && !$role->master_role) {
            return redirect()->route('no-access');
        }
        // check url is start by /user
        if (strpos($request->url(), url('/user')) === 0 && !$role->master_user) {
            return redirect()->route('no-access');
        }
        // check url is start by /products
        if (strpos($request->url(), url('/products')) === 0 && !$role->master_product) {
            return redirect()->route('no-access');
        }


        return $next($request);
    }
}
