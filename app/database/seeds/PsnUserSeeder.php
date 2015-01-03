<?php

use Faker\Factory as Faker;

class PsnUserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 30) as $index) {
            $bronze   = $faker->numberBetween(1, 1000);
            $silver   = $faker->numberBetween(1, 1000);
            $gold     = $faker->numberBetween(1, 1000);
            $platinum = $faker->numberBetween(1, 1000);

            PsnUser::create([
                'username' => $faker->userName(),
                'level'    => $faker->numberBetween(1, 10),
                'trophies' => $bronze + $silver + $gold + $platinum,
                'bronze'   => $bronze,
                'silver'   => $silver,
                'gold'     => $gold,
                'platinum' => $platinum,
            ]);
        }
    }
}