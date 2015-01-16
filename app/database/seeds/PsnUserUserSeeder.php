<?php

use Faker\Factory as Faker;

class PsnUserUserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $userIds = User::lists('id');
        $psnUserIds = PsnUser::lists('id');

        foreach(range(1,50) as $index) {
            DB::table('psn_user_user')->insert([
                'user_id'	=> $faker->randomElement($userIds),
                'psn_user_id'	=> $faker->randomElement($psnUserIds)
            ]);
        }
    }
}