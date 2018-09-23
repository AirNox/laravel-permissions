<?php

namespace Airnox\Permissions\Permissions;

trait HasPermissionAttributes
{
    public function getPermissionAttributes($name)
    {
        $permission = $this->permissions()->whereName($name)->first();

        if (!$permission) {
            return collect([]);
        }

        return collect(
            $permission->userPermissions->permission_attributes
        );
    }

    public function addPermissionAttributes($name, $attributes = [])
    {
        if (!$permission = $this->permissions()->whereName($name)->first()) {
            return $this->givePermission($name, $attributes);
        }

        $userPermissionAttributes = $permission->userPermissions->permission_attributes;

        $permission->userPermissions->update([
            'permission_attributes' => collect($attributes)->map(function ($value, $key) use($userPermissionAttributes) {
                dd($userPermissionAttributes[$key] ?? [], $value);
                $userPermissionAttributes[$key] = array_merge(
                    $userPermissionAttributes[$key] ?? [],
                    $value
                );
            }),
        ]);
    }
}
