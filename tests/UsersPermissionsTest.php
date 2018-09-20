<?php

namespace Tests;

use Tests\Helpers\User;

class UsersPermissionsTest extends TestCase
{
    /** @test */
    function users_can_have_permissions_assigned()
    {
        $user = factory('Tests\Helpers\User')->create();
        $user->givePermission('some-permission');

        $this->assertTrue(
            $user->hasPermission('some-permission')
        );
    }

    /** @test */
    function users_can_have_permissions_revoked()
    {
        $user = factory('Tests\Helpers\User')->create();
        $user->givePermission('some-permission');
        $user->revokePermission('some-permission');

        $this->assertFalse(
            $user->hasPermission('some-permission')
        );
    }

    /** @test */
    function if_user_does_not_have_given_permission_revoking_should_have_no_effect()
    {
        $user = factory('Tests\Helpers\User')->create();
        $user->revokePermission('some-permission');

        $this->assertFalse(
            $user->hasPermission('some-permission')
        );
    }
}
