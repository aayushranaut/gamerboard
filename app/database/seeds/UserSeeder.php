<?php

use Faker\Factory as Faker;

class UserSeeder extends Seeder {
    public function run(){
        $faker = Faker::create();

        foreach(range(1, 10) as $index) {
            User::create([
                'username' => $faker->userName(),
                'email'    => $faker->email(),
                'password' => Hash::make($faker->word()),
                'api_key'  => $faker->md5(),
                'api_token'=> $faker->sha1(),
                'domain'   => $faker->domainName()
            ]);
        }
    }
}