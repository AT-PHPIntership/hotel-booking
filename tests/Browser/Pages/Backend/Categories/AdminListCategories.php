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
                    ->assertTitle('Admin | Category')
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
            $browser->visit('/admin/category')
                    ->assertTitle('Admin | Category')
                    ->assertSee('List Categories');
            $element = $browser->element('#table-contain tbody tr');
            $this->assertCount(0, $element);
            $this->assertNull($browser->element('.paginate'));
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
            $browser->visit('/admin/category')
                    ->assertTitle('Admin | Category')
                    ->resize(1920, 2000)
                    ->assertSee('List Categories');
            $element = $browser->element('#table-contain tbody tr');
            $this->assertCount(9, $element);
            $this->assertNull($browser->element('.pagination'));
        });
    }


     /**
     * A Dusk test show record with table has data and ensure paginate.
     *
     * @return void
     */
    public function testShowRecordPaginate()
    {   
        factory(Category::class, 11)->create();
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/category')
                    ->assertTitle('Admin | Category')
                    ->resize(1920, 2000)
                    ->assertSee('List Categories');
            // Count row number in one page
            $element = $browser->element('#table-contain tbody tr');
            $this->assertCount(19, $element);
            $this->assertNull($browser->element('.pagination'));

             // Count row number of pagination
            $paginate_element = $browser->element('.pagination li');
            $this->assertTrue($paginate_elemen == 3);
        });
    }
}
