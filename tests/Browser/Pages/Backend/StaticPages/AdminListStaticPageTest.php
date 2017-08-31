<?php

namespace Tests\Browser\Pages\Backend\StaticPages;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\StaticPage;

class AdminListStaticPageTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test route.
     *
     * @return void
     */
    public function testClickStaticPageURL()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin')
                ->clickLink('Static Pages')
                ->assertPathIs('/admin/static-page')
                ->assertSee('List Static Pages');
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
            $element = $browser->visit('/admin/static-page')
                ->elements('#table-contain tbody tr');
            $this->assertCount(0, $element);
            $browser->assertPathIs('/admin/static-page')
                ->assertSee('List Static Pages');
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
        $this->makeData(9);
        $this->browse(function (Browser $browser) {
            $element = $browser->visit('/admin/static-page')
                ->elements('#table-contain tbody tr');
            $this->assertCount(9, $element);
            $browser->assertPathIs('/admin/static-page')
                ->assertSee('List Static Pages');
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
        $this->makeData(21);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/static-page')
                ->resize(1920, 2000)
                ->assertSee('List Static Pages');
            //Count row number in one page    
            $elements = $browser->elements('#table-contain tbody tr');
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
            $number_page = count($paginate_element) - 2;

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
        $this->makeData(12);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/static-page?page=2');
            $elements = $browser->elements('#table-contain tbody tr');
            $this->assertCount(2, $elements);
            $browser->assertPathIs('/admin/static-page');
            $browser->assertQueryStringHas('page', 2);
        });
    }

    /**
     * Make data to test
     * @param  int $row number row of staticpage will be create
     * @return void
     */
    public function makeData($row)
    {
        factory(StaticPage::class, $row)->create();
    }
}
