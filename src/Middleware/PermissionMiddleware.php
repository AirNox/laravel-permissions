<?php

namespace Airnox\Permissions\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class PermissionMiddleware
{
    protected $auth;

    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }
    
    public function handle($request, Closure $next, $permission)
    {
        if (!$this->auth->check()) {
            throw new HttpException(Response::HTTP_UNAUTHORIZED, 'Unauthenticated.');
        }

        if (!$this->auth->user()->hasPermission($permission)) {
            throw new HttpException(Response::HTTP_FORBIDDEN, 'Unauthorized.');
        }

        return $next($request);
    }
}
