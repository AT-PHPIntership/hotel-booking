<?php

use App\Model\User;
use Faker\Factory as Faker;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $faker = Faker::create();
        User::create([
                'username' => 'tynd',
                'password' => bcrypt('secret'),
                'email' => $faker->unique()->safeEmail,
                'full_name' => $faker->name,
                'phone' => $faker->phoneNumber,
                'is_admin' => '1',
                'is_active' => '1',
        ]);
    }
}
