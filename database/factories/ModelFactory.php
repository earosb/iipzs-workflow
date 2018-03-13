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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Issue::class, function (Faker\Generator $faker) {

    $type = \App\Type::inRandomOrder()->first();
    $user = \App\User::inRandomOrder()->first();
    $status = \App\Status::inRandomOrder()->first();

    return [
        'type_id'     => $type->id,
        'title'       => $faker->sentence,
        'description' => $faker->text,
        'user_id'     => $user->id,
        'status_id'   => $status->id,
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Type::class, function (Faker\Generator $faker) {
    return ['name' => $faker->word];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Status::class, function (Faker\Generator $faker) {
    return ['name' => $faker->word, 'class' => $faker->colorName];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    $user = \App\User::inRandomOrder()->first();
    return [
        'created_by'  => $user->id,
        'description' => $faker->text,
    ];
});
