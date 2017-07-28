<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class StaticPagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Model::unguard();
        factory(App\Model\StaticPage::class, 15)->create();
        $slug = SlugService::createSlug(App\Model\StaticPage::class, 'slug', 'My First StaticPage');
        Model::reguard();

    }
}
