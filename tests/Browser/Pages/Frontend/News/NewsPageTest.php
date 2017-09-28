<?php

namespace Tests\Browser\Pages\Frontend\News;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\Category;
use App\Model\News;
use Faker\Factory as Faker;

class NewsPageTest extends DuskTestCase
{
    use DatabaseMigrations;
    
    /**
     * A Dusk test content.
     *
     * @return void
     */
    public function testListNews()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('News')
                    ->assertSee('TOP NEWS')
                    ->assertPathIs('/news')
                    ->assertTitle('News');
        });
    }

    /**
     * A Dusk test show record with table empty.
     *
     * @return void
     */
    public function testListEmpty()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/news')
                    ->assertSee('TOP NEWS')
                    ->assertTitle('News');
            $elementNews = $browser->elements('.main .content.mt-20 .row .col-md-6');
            $elementCategory = $browser->elements('.main .rooms.mt50.border-left');
            $this->assertCount(1, $elementNews);
            $this->assertCount(0, $elementCategory);
            $this->assertNull($browser->element('.paginate'));
        });
    }

    /**
     * A Dusk test show record with table has data.
     *
     * @return void
     */
    public function testListHasRecord()
    {
        $this->makeData(3, 4);
        $this->browse(function (Browser $browser) {
            $browser->visit('/news')
                    ->assertSee('TOP NEWS')
                    ->assertTitle('News');
            $elementNews = $browser->elements('.main .content.mt-20 .row .col-md-6');
            $elementCategory = $browser->elements('.main .rooms.mt50.border-left');
            $this->assertCount(2, $elementNews);
            $this->assertCount(3, $elementCategory);
            $elementNewsInTopNews = $browser->elements('.main .content.mt-20 .row .col-md-6 .col-md-5');
            $elementNewsInCategory = $browser->elements('.main .rooms.mt50.border-left:nth-child(2) .container .col-md-3');
            $this->assertCount(4, $elementNewsInTopNews);
            $this->assertCount(4, $elementNewsInCategory);
            $this->assertNull($browser->element('.pagination'));
        });
    }

    /**
    * A Dusk test show record with table has data and ensure pagnate.
    *
    * @return void
    */
    public function testShowRecordPaginate()
    {
        $this->makeData(7, 4);
        $this->browse(function (Browser $browser) {
            $browser->visit('/news')
                    ->assertSee('TOP NEWS')
                    ->assertTitle('News');
            $elementNews = $browser->elements('.main .content.mt-20 .row .col-md-6');
            $elementCategory = $browser->elements('.main .rooms.mt50.border-left');
            $this->assertCount(2, $elementNews);
            $this->assertCount(3, $elementCategory);
            $elementNewsInTopNews = $browser->elements('.main .content.mt-20 .row .col-md-6 .col-md-5');
            $elementNewsInCategory = $browser->elements('.main .rooms.mt50.border-left:nth-child(2) .container .col-md-3');
            $this->assertCount(4, $elementNewsInTopNews);
            $this->assertCount(4, $elementNewsInCategory);
            //Count page number of pagination
            $paginate_element = $browser->elements('.pagination li');
            $number_page = count($paginate_element)- 2;
            $this->assertTrue($number_page == 3);
        });
    }

    /**
     * Test click page 2 in pagination link
     *
     * @return void
     */
    public function testPathPagination()
    {   
        $this->makeData(5, 4);
        $this->browse(function (Browser $browser) {
            $browser->visit('/news?page=2')
                    ->assertSee('TOP NEWS')
                    ->assertTitle('News');
            $elementNews = $browser->elements('.main .content.mt-20 .row .col-md-6');
            $elementCategory = $browser->elements('.main .rooms.mt50.border-left');
            $this->assertCount(2, $elementNews);
            $this->assertCount(2, $elementCategory);
            $elementNewsInTopNews = $browser->elements('.main .content.mt-20 .row .col-md-6 .col-md-5');
            $elementNewsInCategory = $browser->elements('.main .rooms.mt50.border-left:nth-child(2) .container .col-md-3');
            $this->assertCount(4, $elementNewsInTopNews);
            $this->assertCount(4, $elementNewsInCategory);
            $browser->assertPathIs('/news');
            $browser->assertQueryStringHas('page', 2);
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
