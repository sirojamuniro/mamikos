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
        // var_dump(auth()->user()->roles);
        $user =  auth()->user()->roles;
        
            if ($user->role_id == 1) {
                return $next($request);
        }

        return $this->forbidden();
    }

    protected function forbidden()
    {
        $response = [
            'status' => false,
            'message' => 'Forbidden, You have not OWNER access',
            'data' => null
        ];

        return response($response, 403);
    }
}
