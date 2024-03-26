<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request)
    {
        if (auth()->check()) {
            $user = auth()->user();
            if ($user->status == 1) {
                auth()->logout();
                return redirect()->route('login')->with('message', 'Wait for the admin approval.');
            }
            if ($user->status == 3) {
                auth()->logout();
                return redirect()->route('login')->with('message', 'You are banned because: ' . $user->ban_reason);
            }
        }

        return route('login');
    }
}