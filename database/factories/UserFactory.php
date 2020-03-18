<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Libreria;
use App\Libro;
//use App\User;
use Faker\Generator as Faker;
//use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

/*$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});*/
$factory->define(Libreria::class, function (Faker $faker){
    return [
        'name' => $faker->firstNameFemale,
        'direction' => $faker->streetAddress,
        'telephone' => $faker->randomElement(['+591'.$faker->numberBetween(766000,799000), null]),
    ];
});

$factory->define(Libro::class, function (Faker $faker){
    //$libreria = Libreria::all()->random();
    return [
        'name' => $faker->randomElement([$faker->randomElement([$faker->firstNameMale, $faker->firstNameFemale]).' '.$faker->citySuffix, $faker->randomElement([$faker->citySuffix, $faker->state]).' '.$faker->city]),
        'author' => $faker->name,
        'pages' => $faker->numberBetween(80, 500),
        'libreria_id' => Libreria::all()->random()->id,
    ];
});
