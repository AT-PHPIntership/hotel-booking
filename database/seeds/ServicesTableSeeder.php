<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        factory(App\Model\Service::class, 15)->create();
        Model::reguard();

    }
}
