<?php

namespace Airnox\Permissions\Permissions;

trait HasPermissions
{
    protected $permissions = [];

    public function hasPermission($name)
    {
        return in_array($name, $this->permissions);
    }

    public function givePermission($name)
    {
        $this->permissions[] = $name;
    }
}
