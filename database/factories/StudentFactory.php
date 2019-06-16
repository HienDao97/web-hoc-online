<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'name'=>$faker->name,
        'gender'=>'1',
        'avatar'=>'http://lorempixel.com/800/600/cats/' ,
        'mobile'=>$faker->e164PhoneNumber,
        'email' => $faker->unique()->safeEmail,
        'password' => Hash::make('123456'),
        'remember_token' => Str::random(10),
    ];
});
