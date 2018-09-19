<?php

namespace Airnox\Permissions;

trait HasPermissions
{
    public function hasPermission($name)
    {
        return false;
    }
}
