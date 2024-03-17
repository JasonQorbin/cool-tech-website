<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminUserForUserPage
{
    /**
     * If accessing the Users view, check if the authenticated user has the 'admin' role and redirect to the base
     * admin view if not.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if ( $request->route('mode') == 'users') {

            $role = User::find(Auth::id())->role;

            if ($role != 'admin') {
                return redirect('/admin/');
            }
        }
        return $next($request);
    }
}
