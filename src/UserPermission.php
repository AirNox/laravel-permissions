<?php

namespace Airnox\Permissions;

use Illuminate\Database\Eloquent\Relations\Pivot;

class UserPermission extends Pivot
{
    protected $casts = [
        'permission_attributes' => 'array',
    ];

    protected $fillable = [
        'permission_attributes',
    ];
}
