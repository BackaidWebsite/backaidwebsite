<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\articlecategories;

use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

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

$factory->define(articlecategories::class, function (Faker $faker) {

    $cate =  $faker->sentence;
    $slug = str_slug($cate, '-');
    return [
        'category' => $cate,
        'slug' =>  $slug,
    ];
});
