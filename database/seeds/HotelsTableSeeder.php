<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class HotelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        factory(App\Model\Hotel::class, 15)->create();
        $slug = SlugService::createSlug(App\Model\Hotel::class, 'slug', 'My First Hotel');
        Model::reguard();
    }
}
