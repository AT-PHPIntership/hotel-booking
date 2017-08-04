<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class FeedbacksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        factory(App\Model\Feedback::class, 15)->create();
        Model::reguard();
    }
}
