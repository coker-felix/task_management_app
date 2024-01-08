<?php

namespace App\Http\Middleware;

use App\Models\UserActivity;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class LogUserActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);
        if (Auth::check()) {
            UserActivity::create([
                'user_id' => Auth::user()->id,
                'route' => $request->path(),
                'method' => $request->method(),
                'request_timestamp' => now(),
            ]);
        }
        return $response;
    }
}
