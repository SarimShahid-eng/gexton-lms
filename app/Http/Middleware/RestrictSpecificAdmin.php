<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RestrictSpecificAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
   public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // block user id=1 & role=admin
        if ($user && $user->id == 1 && $user->user_type === 'admin') {
            // You can abort or redirect
            abort(404);
            // return redirect()->route('home') // change to your safe page
            //     ->with('error', 'You are not allowed to access this page.');
        }

        return $next($request);
    }
}
