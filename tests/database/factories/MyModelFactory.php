<?php

use \Faker\Generator;
use Spatie\Skeleton\Models\MyModel;

/* @var Illuminate\Database\Eloquent\Factory $factory */
$factory->define(MyModel::class, function (Generator $faker) {
    return [
        'name' => $faker->firstName,
    ];
});
