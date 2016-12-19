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

$factory->define(\CodEditora\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        //'papel' => rand(1,3),
    ];
});

$factory->define(\CodEditora\Models\Category::class, function (Faker\Generator $faker) {

    return [
        'name' => ucfirst($faker->unique()->word),
    ];
});


$factory->define(\CodEditora\Models\Book::class, function (Faker\Generator $faker) {

    $repository1 = app(\CodEditora\Repositories\UserRepository::class);
    $authorId = $repository1->all()->random()->id;

    $repository2 = app(\CodEditora\Repositories\CategoryRepository::class);
    $categoryId = $repository2->all()->random()->id;

    return [
        'title' => $faker->sentence(2),
        'subtitle' => $faker->sentence(3),
        'price' => $faker->randomFloat(2,10,100),
        'author_id'=> $authorId,
        'category_id' => $categoryId,
    ];
});

