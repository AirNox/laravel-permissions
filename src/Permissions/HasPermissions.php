<?php

namespace Airnox\Permissions\Permissions;

use Airnox\Permissions\UserPermission;

trait HasPermissions
{
    use HasPermissionAttributes;
    
    protected $permissions = [];

    public function permissions()
    {
        return $this->belongsToMany(
            Permission::class,
            'permissions_users'
        )->as('userPermissions')
         ->withPivot('permission_attributes')
         ->using(UserPermission::class);
    }

    public function hasPermission($name)
    {
        return $this->permissions()->whereName($name)->exists();
    }

    public function givePermission($name, $attributes = [])
    {
        $permission = Permission::firstOrCreate(compact('name'));

        $this->permissions()->attach(
            $permission,
            [ 'permission_attributes' => $attributes ]
        );
    }

    public function revokePermission($name)
    {
        $permission = Permission::firstOrCreate(compact('name'));

        $this->permissions()->detach($permission);
    }
}
