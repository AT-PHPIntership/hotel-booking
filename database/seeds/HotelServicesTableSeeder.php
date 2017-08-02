<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class HotelServicesTableSeeder extends Seeder
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
        $servicesId = App\Model\Service::all('id')->pluck('id')->toarray();

        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            factory(App\Model\HotelService::class, 1)->create([
                'hotel_id' => $faker->randomElement($hotelsId),
                'service_id' => $faker->randomElement($servicesId)
            ]);
        }
        Model::reguard();
    }
}
