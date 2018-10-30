<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        factory(User::class)
            ->create([
                'email'    => 'trusty@arkx.io',
                'password' => Hash::make(str_random(128)),
            ])
            ->assignRole('admin');

        if (app()->environment('local', 'testing')) {
            factory(User::class)
                ->create(['email' => 'dummy@arkx.io'])
                ->assignRole('delegate');
        }
    }
}
