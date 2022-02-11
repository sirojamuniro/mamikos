<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user =  auth()->user()->profile->roles->has_roles;
            if ($user->name == "ADMIN") {
                return $next($request);
        }

        return $this->forbidden();
    }

    protected function forbidden()
    {
        $response = [
            'status' => false,
            'message' => 'Forbidden, You have not admin access',
            'data' => null
        ];

        return response($response, 403);
    }
}
