<?php

namespace Tests\Browser\Pages\Frontend\News;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\News;
use App\Model\Category;
use Faker\Factory as Faker;

class UserReadNewsTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test value for news has not relative news.
     *
     * @return void
     */
    public function testValueShowNews()
    {
        $this->makeData(1, 1);
        $news = News::find(1);
        $this->browse(function (Browser $browser) use ($news) {
            $browser->visit('/news')
                    ->click('.content.mt-20 .row .col-md-6:nth-child(1)')
                    ->assertPathIs('/news/'.$news->slug)
                    ->assertSeeIn('#reservation-form .container .row h2', $news->title)
                    ->assertSeeIn('#reservation-form .container .row div', $news->content)
                    ->assertDontSee('Relative news');
        });
    }

    /**
     * Test value for news has relative news.
     *
     * @return void
     */
    public function testValueShowNewsHasRelativeNews()
    {
        $this->makeData(1, 5);
        $news = News::find(1);
        $this->browse(function (Browser $browser) use ($news) {
            $browser->visit('/news')
                    ->click('.content.mt-20 .row .col-md-6:nth-child(1)')
                    ->assertPathIs('/news/'.$news->slug)
                    ->assertSeeIn('#reservation-form .container .row h2', $news->title)
                    ->assertSeeIn('#reservation-form .container .row div', $news->content)
                    ->assertSee('Relative news');
            $elementRelativeNews = $browser->elements('.rooms.mt50.border-left .container .col-md-3');
            $this->assertCount(4, $elementRelativeNews);
        });
    }

    /**
     * Test 404 Page Not found when click show news.
     *
     * @return void
     */
    public function test404PageForClickShow()
    {   
        $this->makeData(1, 1);
        $news = News::find(1);
        $this->browse(function (Browser $browser) use ($news) {
            $browser->visit('/news')
                    ->assertSee('TOP NEWS');
            $news->delete();
            $browser->click('.content.mt-20 .row .col-md-6:nth-child(1)')
                    ->assertSee('404 - Page Not found');
        });
    }

    /**
     * Make data for test.
     *
     * @return void
     */
    public function makeData($idCategory, $rowNews)
    {   
        factory(Category::class, $idCategory)->create();
        $faker = Faker::create();
        for ($i = 1; $i <= $idCategory; $i++) {
            for ($j = 0; $j < $rowNews; $j++) {
                factory(News::class, 1)->create([
                    'category_id' => $i
                ]);
            };
        };
    }
}
