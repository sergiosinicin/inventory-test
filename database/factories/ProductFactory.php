<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class,
    function (Faker $faker) {

        //$image = $faker->image('public/storage/images/products/', 300, 300, null, false);

        $files = glob(public_path('storage/images/products/*.jpg'));
        $image = basename(array_random($files));
        if(!$image) {
            $image = $faker->image('public/storage/images/products/', 300, 300, null, false);
        }

        return [
            'name' => $faker->word(),
            'code' => $faker->randomNumber(),
            'details' => $faker->sentence(),
            'image' => 'storage/images/products/'.$image,
        ];
    });
