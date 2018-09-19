<?php

namespace Airnox\Permissions\Permissions;

trait HasPermissions
{
    protected $permissions = [];

    public function permissions()
    {
        return $this->belongsToMany(
            Permission::class,
            'permissions_users'
        );
    }

    public function hasPermission($name)
    {
        return $this->permissions()->whereName($name)->exists();
    }

    public function givePermission($name)
    {
        $permission = Permission::firstOrCreate(compact('name'));

        $this->permissions()->attach($permission);
    }

    public function revokePermission($name)
    {
        $permission = Permission::firstOrCreate(compact('name'));

        $this->permissions()->detach($permission);
    }
}
