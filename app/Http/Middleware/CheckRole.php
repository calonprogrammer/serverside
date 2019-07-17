<?php

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */

    public function handle($request, Closure $next, $role)
    {
        if(!auth()->user()->type == $role) {
            return response()->json([
                'message'=>'Not Authenticate'],401);
        }
        $request->user = auth()->user();
        return $next($request);
    }
}
