<?php

namespace Tests;

use Illuminate\Support\Facades\Route;
use Tests\Helpers\User;

class PermissionsTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        Route::get('/no-permissions', function () { return 'OK'; });
        Route::get('/permissions', function () { return 'OK'; })
            ->middleware('permission:some-permission');
    }

    /** @test */
    function endpoint_without_permission_middleware_can_be_accessed()
    {
        $this->get('/no-permissions')
            ->assertStatus(200);
    }

    /** @test */
    function endpoint_that_requires_permissions_cannot_be_accessed_by_guests()
    {
        $this->get('/permissions')
            ->assertStatus(401);
    }

    /** @test */
    function endpoint_that_requires_permissions_cannot_be_accessed_by_users_without_that_permission()
    {
        auth()->login(new User);

        $this->get('/permissions')
            ->assertStatus(403);
    }
}
