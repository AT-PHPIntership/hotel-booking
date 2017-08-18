<?php

namespace Tests\Browser\Pages\Backend\Categories;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\Model\Category;

class AdminListCategories extends DuskTestCase
{   
    use DatabaseMigrations;

    /**
     * A Dusk test test Route.
     *
     * @return void
     */
    public function testRoute()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin')
                    ->clickLink('Categories')
                    ->assertPathIs('/admin/category')
                    ->assertSee('List Categories');
        });
    }

    /**
     * A Dusk test empty data.
     *
     * @return void
     */
    public function testEmptyData()
    {
        $this->browse(function (Browser $browser) {
            $element = $browser->visit('/admin/category')->element('#table-contain tbody tr');
            $count = count($element);
            $this->assertTrue($count == 0);
            $browser->assertPathIs('/admin/category')
                    ->assertSee('List Categories');
            $this->assertNull($browser->element('.pagination'));
        });
    }

     /**
     * A Dusk test show record with table has data.
     *
     * @return void
     */
    public function testShowRecord()
    {   
        factory(Category::class, 9)->create();
        $this->browse(function (Browser $browser) {
            $element = $browser->visit('/admin/category')->elements('#table-contain tbody tr');
            $count = count($element);
            $this->assertTrue($count == 9);
            $browser->assertPathIs('/admin/category')
                    ->assertSee('List Categories');
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
        factory(Category::class, 21)->create();
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/category')
                ->resize(1920, 2000)
                ->assertSee('List Categories');
            //Count row number in one page    
            $elements = $browser->elements('#table-contain tbody tr');
            $this->assertCount(10, $elements);
            $this->assertNotNull($browser->element('.pagination'));

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
        factory(Category::class, 12)->create();
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/category?page=2');
            $elements = $browser->elements('#table-contain tbody tr');
            $this->assertCount(2, $elements);
            $browser->assertPathIs('/admin/category');
            $browser->assertQueryStringHas('page', 2);
        });
    }
}
