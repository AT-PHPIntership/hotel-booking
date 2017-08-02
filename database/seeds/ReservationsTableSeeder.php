<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $roomsId = App\Model\Room::all('id')->pluck('id')->toarray();
        $faker = Faker::create();
        for ($i = 0; $i < 30; $i++) {
            factory(App\Model\Reservation::class, 1)->create([
                'room_id' => $faker->randomElement($roomsId),
            ]);
        }
        Model::reguard();
    }
}
