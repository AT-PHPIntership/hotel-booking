<?php

namespace Tests\Browser\Pages\Backend\News;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\Category;
use App\Model\News;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AdminEditNewsTest extends DuskTestCase
{   
    use DatabaseMigrations;

    /**
     * Test Route Admin Edit News.
     *
     * @return void
     */
    public function testAdminEditNews()
    {
        $this->makeData(10);
        $news = News::find(10);
        $this->browse(function (Browser $browser) use ($news) {
            $browser->visit('/admin/news')
                    ->click('#newstable tbody tr:nth-child(1) td:nth-child(4) a')
                    ->assertSee('EDIT NEWS')
                    ->assertPathIs('/admin/news/'.$news->slug.'/edit');
        });
    }

    /**
     * Test Edit News Success.
     *
     * @return void
     */
    public function testEditNewsSuccess()
    {
        $this->makeData(10);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news')
                    ->click('#newstable tbody tr:nth-child(2) td:nth-child(4) a')
                    ->type('title','News20')
                    ->press('Submit')
                    ->assertSee('Edit News Success!')
                    ->assertPathIs('/admin/news');
        });
        $this->assertDatabaseHas('news', [
                        'title' => 'News20']);
    }

    /**
     * Test Buton Back in page Edit News.
     *
     * @return void
     */
    public function testBtnCancer()
    {
        $this->makeData(10);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news')
                    ->click('#newstable tbody tr:nth-child(2) td:nth-child(4) a')
                    ->assertSee('EDIT NEWS')
                    ->clickLink('Back')
                    ->assertSee('List News')
                    ->assertPathIs('/admin/news');
        });
    }

    /**
     *List case for test validation Edit News
     *
     *@return array
     */
    public function listCaseTestForEditNews()
    {
        return [
            ['', 'content','The title field is required.'],
            ['news title', '', 'The content field is required.'],
        ];
    }

    /**
     * @dataProvider listCaseTestForEditNews
     *
     */
    public function testValidateEditNews($title, $content, $msg)
    {
        $this->makeData(10);
        $news = News::find(10);
        $this->browse(function (Browser $browser) 
            use ($news, $title, $content, $msg) {
            $page = $browser->visit('/admin/news')
                ->click('#newstable tbody tr:nth-child(1) td:nth-child(4) a')
                ->type('title', $title);
            $this->typeInCKEditor($browser, '#cke_1_contents iframe', $content);
            $page->press('Submit')
                ->assertSee($msg)
                ->assertPathIs('/admin/news/'.$news->slug.'/edit');
        });
    }

    /**
     * Test Error 404 Page.
     *
     * @return void
     */
    public function test404Page()
    {
        $this->makeData(10);
        $news = News::find(10);
        $this->browse(function (Browser $browser) use ($news) {
            $browser->visit('/admin/news')
                    ->click('#newstable tbody tr:nth-child(1) td:nth-child(4) a')
                    ->assertSee('EDIT NEWS');
            $news->delete();
            $browser->press('Submit')
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
        factory(Category::class, 1)->create();
        $categoryIds = Category::all('id')->pluck('id')->toArray();
        $faker = Faker::create();
        for ($i = 0; $i < $row; $i++) {
            factory(News::class, 1)->create([
                'category_id' => $faker->randomElement($categoryIds),
            ]);
        }
    }
}
