<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        factory(App\Model\News::class, 15)->create();
        $slug = SlugService::createSlug(App\Model\News::class, 'slug', 'My First News');
        Model::reguard();
    }
}
