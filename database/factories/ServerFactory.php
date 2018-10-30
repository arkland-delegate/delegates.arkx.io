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
$factory->define(App\Models\Server::class, function (Faker\Generator $faker) {
    return [
        'country_id' => 1,
        'cpu'        => '4 Cores',
        'ram'        => '12 GB DDR4 RAM',
        'disk'       => '60 GB SSD',
        'connection' => '1GB',
    ];
});
