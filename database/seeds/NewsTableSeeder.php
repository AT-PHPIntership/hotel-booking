<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Faker\Factory as Faker;

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
        $categoriesId = App\Model\Category::all('id')->pluck('id')->toarray();
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            factory(App\Model\News::class, 1)->create([
                'category_id' => $faker->randomElement($categoriesId),
            ]);
        }
        SlugService::createSlug(App\Model\News::class, 'slug', 'My First News');
        Model::reguard();
    }
}
