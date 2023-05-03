<?php
use Faker\Generator as Faker;

$factory->define(App\Client::class, function (Faker $faker) {
    $sexes = ['M', 'F'];
    $sexe = $faker->randomElement($sexes);

    return [
        'nom' => $faker->name,
        'dateN' => $faker->date,
        'sexe' => $sexe,
    ];
});


?>