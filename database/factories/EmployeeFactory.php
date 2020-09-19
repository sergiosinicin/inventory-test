<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Employee;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {

    $image = null;
    //$image = $faker->image('public/backend/employee/', 240, 200, null, false);
    $files = glob(public_path('backend/employee/*.jpg'));
    if ($files) {
        $image = basename(array_random($files));
    }
    if (count($files) < 10) {
        $image = basename($faker->image('public/backend/employee/', 240, 200, null, false));
    }

    return [
        'name' => $faker->userName,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'nid' => $faker->sentence,
        'email' => $faker->email,
        'salary' => $faker->numberBetween(1000, 1000000),
        'joining_date' => $faker->date(),
        'photo' => '/backend/employee/'.$image,
    ];
});
