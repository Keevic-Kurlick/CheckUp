<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;

class UserIsPatientOrNotAuth
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = \Auth::user();

        if (!empty($user) && $user->role->name !== Role::ROLE_PATIENT) {
            abort(404);
        }

        return $next($request);
    }
}
