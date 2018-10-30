<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use DatabaseMigrations;
    use Concerns\CreatesRecords;

    public function setUp()
    {
        parent::setUp();

        $this->artisan('db:seed', ['--class' => \CountrySeeder::class]);
        $this->artisan('db:seed', ['--class' => \RolesAndPermissionsSeeder::class]);
    }
}
