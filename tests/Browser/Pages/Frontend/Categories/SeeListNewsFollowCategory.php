<?php

namespace Tests\Browser\Pages\Frontend\Categories;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\Category;
use App\Model\News;
use Faker\Factory as Faker;

class SeeListNewsFollowCategory extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test show record with list empty.
     *
     * @return void
     */
    public function testListEmpty()
    {
        $this->makeData(1, 0);
        $this->browse(function (Browser $browser) {
            $category = Category::find(1);
            $browser->visit('/categories/' . $category->slug . '/news')
                    ->assertSee('List news of '. $category->name)
                    ->assertTitle('NEWS FOR CATEGORY');
            $element = $browser->elements('.main .rooms.mt50 .container .row .col-md-3:nth-child(2)');
            $this->assertCount(0, $element);
            $this->assertNull($browser->element('.paginate'));
        });
    }

    /**
     * A Dusk test show record with list has data.
     *
     * @return void
     */
    public function testListHasRecord()
    {
       $this->makeData(1, 11);
        $this->browse(function (Browser $browser) {
            $category = Category::find(1);
            $browser->visit('/categories/' . $category->slug . '/news')
                    ->assertSee('List news of '. $category->name)
                    ->assertTitle('NEWS FOR CATEGORY');
            $element = $browser->elements('.main .rooms.mt50 .container .row .col-md-3');
            $this->assertCount(11, $element);
            $this->assertNull($browser->element('.paginate'));
        });
    }

    /**
    * A Dusk test show record with list has data and ensure pagnate.
    *
    * @return void
    */
    public function testShowRecordPaginate()
    {
        $this->makeData(1, 13);
        $this->browse(function (Browser $browser) {
            $category = Category::find(1);
            $browser->visit('/categories/' . $category->slug . '/news')
                    ->assertSee('List news of '. $category->name)
                    ->assertTitle('NEWS FOR CATEGORY');
            $element = $browser->elements('.main .rooms.mt50 .container .row .col-md-3');
            $this->assertCount(12, $element);
            //Count page number of pagination
            $paginate_element = $browser->elements('.pagination li');
            $number_page = count($paginate_element)- 2;
            $this->assertTrue($number_page == 2);
        });
    }

    /**
     * Test click page 2 in pagination link
     *
     * @return void
     */
    public function testPathPagination()
    {   
        $this->makeData(1, 13);
        $this->browse(function (Browser $browser) {
            $category = Category::find(1);
            $browser->visit('/categories/' . $category->slug . '/news?page=2')
                    ->assertSee('List news of '. $category->name)
                    ->assertTitle('NEWS FOR CATEGORY');
            $element = $browser->elements('.main .rooms.mt50 .container .row .col-md-3');
            $this->assertCount(1, $element);
            $browser->assertPathIs('/categories/' . $category->slug . '/news');
            $browser->assertQueryStringHas('page', 2);
        });
    }
    
    /**
     * Make data for test.
     *
     * @return void
     */
    public function makeData($rowCategory, $rowNews)
    {   
        $categories = factory(Category::class, $rowCategory)->create();
        $faker = Faker::create();
        foreach($categories as $category) {
            factory(News::class, $rowNews)->create([
                'category_id' => $category->id
            ]);
        };
    }
}
