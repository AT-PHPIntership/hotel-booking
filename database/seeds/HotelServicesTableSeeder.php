<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

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
        factory(App\Model\HotelService::class, 15)->create();
        Model::reguard();
    }
}
