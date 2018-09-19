<?php

namespace Tests\Helpers;

use Airnox\Permissions\Permissions\HasPermissions;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable as AuthorizableTrait;

class User extends Model implements Authenticatable, Authorizable
{
    use AuthenticatableTrait, AuthorizableTrait, HasPermissions;

    protected $table = 'users';
}
