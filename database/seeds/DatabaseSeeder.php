<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        if ('production' === app()->environment()) {
            die("Taking me seriously is a big mistake. I certainly wouldn't.");
        }

        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CountrySeeder::class);
        // $this->call(DelegateSeeder::class);
    }
}
