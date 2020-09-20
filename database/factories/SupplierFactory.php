<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Suppliers;
use Faker\Generator as Faker;

$factory->define(Suppliers::class, function (Faker $faker) {
    $image = null;
    //$image = $faker->image('public/backend/supplier/', 240, 200, null, false);
    $files = glob(public_path('backend/supplier/*.jpg'));
    if ($files) {
        $image = basename(array_random($files));
    }
    if (count($files) < 10) {
        $image = basename($faker->image('public/backend/supplier/', 240, 200, null, false));
    }

    return [
        'name' => $faker->userName,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'shop_name' => $faker->sentence,
        'email' => $faker->email,
        'photo' => '/backend/supplier/'.$image,
    ];
});
