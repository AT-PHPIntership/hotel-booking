<?php

namespace Tests\Browser\Pages\Backend\StaticPages;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Model\StaticPage;

class AdminListStaticPageTest extends DuskTestCase
{
    use DatabaseMigrations;

    // /**
    //  * A Dusk test route.
    //  *
    //  * @return void
    //  */
    // public function testRoute()
    // {
    //     $this->browse(function (Browser $browser) {
    //         $browser->visit('/admin')
    //                 ->clickLink('Introduction')
    //                 ->assertPathIs('/admin/static-page')
    //                 ->assertSee('Static Page');
    //     });
    // }

    /**
     * A Dusk test empty data.
     *
     * @return void
     */
    public function testEmptyData()
    {
        $this->browse(function (Browser $browser) {
            $element = $browser->visit('/admin/static-page')->elements('#table-contain tbody tr');
            $this->assertCount(0, $element);
            $browser->assertPathIs('/admin/static-page')
                    ->assertSee('Static Page');
            $this->assertNull($browser->element('.pagination'));
        });
    }

    // /**
    //  * A Dusk test show record with table has data.
    //  *
    //  * @return void
    //  */
    // public function testShowRecord()
    // {   
    //     factory(StaticPage::class, 9)->create();
    //     $this->browse(function (Browser $browser) {
    //         $element = $browser->visit('/admin/static-page')->elements('#table-contain tbody tr');
    //         $this->assertCount(9, $element);
    //         $browser->assertPathIs('/admin/static-page')
    //                 ->assertSee('Static Page');
    //         $this->assertNull($browser->element('.pagination'));

    //     });
    // }

    /**
    * A Dusk test show record with table has data and ensure pagnate.
    *
    * @return void
    */
    public function testShowRecordPaginate()
    {
        factory(StaticPage::class, 21)->create();
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/static-page')
                ->resize(1920, 2000)
                ->assertSee('Static Page');

            //Count row number in one page    
            $elements = $browser->elements('#table-contain tbody tr');
            echo count($elements);
            $this->assertCount(10, $elements);
            $this->assertNotNull($browser->element('.pagination'));
            // test paginate button
            $browser->press('.pagination li:nth-child(3) a')
                    ->assertPathIs('/admin/static-page')
                    ->assertQueryStringHas('page', '2');
            $elements = $browser->elements('#table-contain tbody tr');
            $this->assertCount(10, $elements);
            //Count page number of pagination
            $paginate_element = $browser->elements('.pagination li');
            $number_page = count($paginate_element)- 2;

            $this->assertTrue($number_page == 3);
        });
    }
}
