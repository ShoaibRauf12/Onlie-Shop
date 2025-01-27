<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class AdminAuthenticate extends Middleware
{
    
    public function redirectTo($request)
    {
       return $request->expectsJson() ? null : route('admin.login');
    }

    protected function authenticate($request, array $guards)
    {
       
            if ($this->auth->guard('admin')->check()) {
                return $this->auth->shouldUse('admin');
            }

        $this->unauthenticated($request, ['admin']);
    }
}
