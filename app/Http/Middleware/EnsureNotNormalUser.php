<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureNotNormalUser
{
    /**
     * Check if the authenticated user has the 'writer' or 'admin' role and redirect to the home page if not.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $role = User::find(Auth::id())->role;

        if ($role == 'user'){
            return redirect('/');
        }

        return $next($request);
    }
}
