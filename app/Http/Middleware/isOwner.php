<?php

namespace App\Http\Middleware;

use Closure;

class isOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $role = auth()->user()->role->name;
        $allowedRoles = ['partner', 'user', 'collaborator'];

        // if logged user role is one of allowedRoles, then redirect to dashboard
        // otherwise redirect to user index
        if (in_array($role, $allowedRoles)) {
            return abort(403);
        }

        return $next($request);
    }
}
