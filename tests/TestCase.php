<?php

namespace Tests;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->loadLaravelMigrations();
        
        $this->app->make('Illuminate\Database\Eloquent\Factory')
            ->load(__DIR__ . '/Helpers/factories');

        $this->artisan('migrate');
    }

    protected function getPackageProviders($app)
    {
        return [ 'Airnox\Permissions\PermissionsServiceProvider' ];
    }
}
