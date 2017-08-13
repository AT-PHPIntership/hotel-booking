<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class RatingCommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $hotelIds = App\Model\Hotel::all('id')->pluck('id')->toArray();
        $userIds = App\Model\User::all('id')->pluck('id')->toArray();
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            factory(App\Model\RatingComment::class, 1)->create([
                'hotel_id' => $faker->randomElement($hotelIds),
                'user_id' => $faker->randomElement($userIds)
            ]);
        }
        Model::reguard();
    }
}
