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
        DB::table('services')->insert([[
            'name' => 'Quầy bar ',
        ],[
            'name' => 'Dịch vụ Spa ',
        ],[
            'name' => 'Fitness center',
        ],[
            'name' => 'Dịch vụ hội họp',
        ],[
            'name' => 'Dịch vụ giặt ủi quần áo',
        ],[
            'name' => 'Dịch vụ xe đưa đón sân bay',
        ],[
            'name' => 'Dịch vụ trông trẻ',
        ]]);

    }
}
