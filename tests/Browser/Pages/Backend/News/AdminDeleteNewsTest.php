<?php

namespace Tests\Browser\Pages\Backend\News;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Faker\Factory as Faker;
use App\Model\Category;
use App\Model\News;

class AdminDeleteNewsTest extends DuskTestCase
{   
    use DatabaseMigrations;

    /**
     * Test Delete News Success.
     *
     * @return void
     */
    public function testDeleteNewsSuccess()
    {   
        $this->makeData(10);
        $news = News::find(10);
        $this->browse(function (Browser $browser) use ($news) {
            $browser->visit('/admin/news')
                    ->assertSee('List News')
                    ->press('#newstable tbody tr:nth-child(1) td:nth-child(4) button')
                    ->waitForText('Confirm deletion!')
                    ->press('Delete')
                    ->assertSee('Delete News Success!');
        });
        $this->assertSoftDeleted('news',[
            'id' => '10']);
    }

    /**
     * Test 404 Page Not found when delete News.
     *
     * @return void
     */
    public function test404Page()
    {   
        $this->makeData(10);
        $news = News::find(10);
        $this->browse(function (Browser $browser) use ($news) {
            $browser->visit('/admin/news')
                    ->assertSee('List News')
                    ->press('#newstable tbody tr:nth-child(1) td:nth-child(4) button');
            $news->delete();
            $browser->waitForText('Confirm deletion!')
                    ->press('Delete')
                    ->assertSee('404 - Page Not found');
        });
    }

    /**
     * Make data for test.
     *
     * @return void
     */
    public function makeData($row)
    {   
        factory(Category::class, 10)->create();
        $categoryIds = Category::all('id')->pluck('id')->toArray();
        $faker = Faker::create();
        for ($i = 0; $i < $row; $i++) {
            factory(News::class, 1)->create([
                'category_id' => $faker->randomElement($categoryIds),
            ]);
        }
    }
}
