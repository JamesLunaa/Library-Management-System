<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAccountLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $level
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $level)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect('/login'); // Redirect to login if not authenticated
        }

        // Get the authenticated user
        $user = Auth::user();

        // Check if the user's account level matches the required level
        if ($user->accLevel !== $level) {
            return redirect('/'); // Redirect to a suitable page if access is denied
        }

        return $next($request); // Proceed to the next middleware or the request
    }
}