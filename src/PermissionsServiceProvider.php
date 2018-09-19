<?php

namespace Airnox\Permissions;

use Airnox\Permissions\Middleware\PermissionMiddleware;
use Illuminate\Support\ServiceProvider;

class PermissionsServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app['router']
            ->aliasMiddleware('permission', PermissionMiddleware::class);
    }

    public function boot()
    {
    }
}
