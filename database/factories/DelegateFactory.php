<?php


/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/* @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Delegate::class, function (Faker\Generator $faker) {
    return [
        'country_id'       => 1,
        'user_id'          => 1,
        'type'             => $faker->boolean ? 'public' : 'private',
        'username'         => $faker->unique()->username,
        'address'          => str_random(34),
        'public_key'       => str_random(66),
        'rank'             => 1,
        'extra_attributes' => [
            'profile' => [
                'country_id'   => 1,
                'logo'         => $faker->imageUrl,
                'website'      => $faker->url,
                'proposal'     => $faker->url,
                'details'      => $faker->paragraph,
            ],
            'sharing' => [
                'percentage'      => $faker->numberBetween(75, 95),
                'frequency'       => 'Every 24 Hours',
                'threshold'       => 0.1,
                'running_balance' => $faker->boolean,
                'covers_fee'      => $faker->boolean,
                'details'         => $faker->paragraph,
            ],
            'voting' => [
                'fidelity' => [
                    'period'  => '7 Days',
                    'share'   => $faker->numberBetween(10, 30),
                    'details' => $faker->paragraph,
                ],
                'requirements' => [
                    'min_balance'  => 1,
                    'max_balance'  => 1,
                    'registration' => $faker->boolean,
                    'details'      => $faker->paragraph,
                ],
            ],
            'statistics' => [
                // 'rank'         => $faker->numberBetween(1, 100),
                // 'votes'        => $faker->randomNumber(9) * 1000000,
                // 'approval'     => $faker->numberBetween(1, 2),
                // 'productivity' => $faker->numberBetween(1, 2),
                'producedblocks' => 54442,
                'missedblocks'   => 136,
                'approval'       => 1.06,
                'productivity'   => 99.75,
                'voters'         => 100,
            ],
            'calculator' => [
                'cap_at_maximum_balance'       => $faker->boolean,
                'ignore_above_maximum_balance' => $faker->boolean,
                    'details'                  => $faker->paragraph,
            ],
        ],
    ];
});
