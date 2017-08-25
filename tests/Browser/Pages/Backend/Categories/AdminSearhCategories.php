<?php

namespace Tests\Browser\Pages\Backend\Categories;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Model\Category;

class AdminSearhCategories extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test dont type value.
     *
     * @return void
     */
    public function testNotType()
    {
        $this->makeData(10);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/category')
                    ->press('.btn-search')
                    ->assertQueryStringMissing('search');
        });
    }

    /**
     *Test search if has input value and has one record.
     *
     * @return void
     */
    public function testSearchOneValue()
    {
        $this->makeData(1);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/category')
                    ->type('search', 'category')
                    ->press('.btn-search');
            $elements = $browser->elements('#table-contain tbody tr');
            $this->assertCount(1, $elements);
            $this->assertNull($browser->element('.pagination')); 
        });
    }

    /**
     *Test search if has input value and has many record.
     *
     * @return void
     */
    public function testSearchManyValue()
    {
       $this->makeData(15);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/category')
                    ->type('search', 'category')
                    ->press('.btn-search');
            $elements = $browser->visit('/admin/category?search=category')->elements('#table-contain tbody tr');
            $this->assertCount(10, $elements);
            $browser->press('.pagination li:nth-child(3) a');
            $elements = $browser->visit('/admin/category?search=category&page=2')->elements('#table-contain tbody tr');
            $this->assertCount(5, $elements);
            $browser->assertPathIs('/admin/category')
                    ->assertQueryStringHas('search', 'category')
                    ->assertQueryStringHas('page', '2');

            $paginate_element = $browser->elements('.pagination li');
            $number_page = count($paginate_element)- 2;

            $this->assertTrue($number_page == 2);
        });
    }

    /**
     *Test search if has input value and no one record.
     *
     * @return void
     */
    public function testSearchNotFound()
    {
       $this->makeData(10);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/category')
                    ->type('search', 'sdfdsfds')
                    ->press('.btn-search')
                    ->assertSee('Data Not Found');
            $elements = $browser->elements('#table-contain tbody tr');
            $this->assertCount(0, $elements);
            $this->assertNull($browser->element('.pagination'));
        });   
    }

     /**
     * Make data for test
     *
     * @return void
     */
    public function makeData($row)
    {
        for ($i=1; $i <= $row ; $i++) { 
            Category::create([
                'name' => 'category'.$i
                ]);
        }
    }
}
