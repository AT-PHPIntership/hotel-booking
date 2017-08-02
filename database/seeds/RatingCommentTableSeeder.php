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
        $hotelsId = App\Model\Hotel::all('id')->pluck('id')->toarray();
        $usersId = App\Model\User::all('id')->pluck('id')->toarray();
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            factory(App\Model\RatingComment::class, 1)->create([
                'hotel_id' => $faker->randomElement($hotelsId),
                'user_id' => $faker->randomElement($usersId)
            ]);
        }
        Model::reguard();
    }
}
