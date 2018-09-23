<?php

namespace Tests\Permissions;

use Tests\TestCase;

class PermissionAttributesTest extends TestCase
{
    /** @test */
    function if_user_has_no_permission_attributes_are_empty()
    {
        $user = factory('Tests\Helpers\User')->create();

        $this->assertEquals(
            collect([]), $user->getPermissionAttributes('some-permission')
        );
    }

    /** @test */
    function if_not_set_attributes_are_empty_by_default()
    {
        $user = factory('Tests\Helpers\User')->create();
        $user->givePermission('some-permission');

        $this->assertEquals(
            collect([]), $user->getPermissionAttributes('some-permission')
        );
    }

    /** @test */
    function permission_attributes_can_be_set_while_giving_permission()
    {
        $user = factory('Tests\Helpers\User')->create();
        $user->givePermission('some-permission', [ 'id' => 1 ]);

        $this->assertEquals(
            collect([ 'id' => 1 ]), $user->getPermissionAttributes('some-permission')
        );
    }

    /** @test */
    function permission_attributes_can_be_assigned_at_any_time()
    {
        $user = factory('Tests\Helpers\User')->create();
        $user->givePermission('some-permission');
        $user->addPermissionAttributes('some-permission', [ 'id' => 1 ]);

        $this->assertEquals(
            collect([ 'id' => 1 ]), $user->getPermissionAttributes('some-permission')
        );
    }

    /** @test */
    function if_user_does_not_has_permission_attributes_can_be_assigned_and_permission_is_given_automatically()
    {
        $user = factory('Tests\Helpers\User')->create();
        $user->addPermissionAttributes('some-permission', [ 'id' => 1 ]);

        $this->assertTrue($user->hasPermission('some-permission'));
        $this->assertEquals(
            collect([ 'id' => 1 ]), $user->getPermissionAttributes('some-permission')
        );
    }

    /** @test */
    function permissions_get_merged_if_user_already_has_some()
    {
        $user = factory('Tests\Helpers\User')->create();
        $user->givePermission('some-permission', [ 'id' => [ 1 ]]);
        $user->addPermissionAttributes('some-permission', [ 'id' => [ 2 ]]);

        $this->assertEquals(
            collect([ 'id' => [ 1, 2 ]]), $user->getPermissionAttributes('some-permission')
        );
    }
}
