<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Post;
use Faker\Generator as Faker;
use App\Enums\PostStatusType;

$factory->define(Post::class, function (Faker $faker) {
    $user_ids = App\User::pluck('id');
    $category_ids = App\Category::pluck('id');
    return [
        'title' => $faker->sentence(),
        'content' => $faker->paragraph(20),
        'user_id' => $user_ids->random(),
        'category_id' => $category_ids->random(),
        'status' => $faker->randomElement($array = PostStatusType::getValues()),
    ];
});
