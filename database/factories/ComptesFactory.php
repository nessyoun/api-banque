<?php

use App\Client;
use Faker\Generator as Faker;

$factory->define(App\Compte::class, function (Faker $faker) {
    static $password;

    $client = factory(Client::class)->create();

    return [
        'idClient' => $client->id,
        'solde' => $faker->randomFloat(2, 0, 10000),
        'username' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'type' => $faker->randomElement(['P', 'E', 'I']),
    ];
});

?>
