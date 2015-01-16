<?php

use Faker\Factory as Faker;

class UserSeeder extends Seeder {
    public function run(){
        $faker = Faker::create();
        $users = [];
        $password = Hash::make($faker->word());

        foreach(range(1, 10) as $index) {
            $users[] = [
                'username' => $faker->userName(),
                'email'    => $faker->email(),
                'password' => $password,
                'api_key'  => $faker->md5(),
                'api_token'=> $faker->sha1(),
                'domain'   => $faker->domainName()
            ];
        }

        User::insert($users);
    }
}