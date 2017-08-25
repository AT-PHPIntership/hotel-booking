<?php

namespace Tests\Browser\Backend\Services;

use App\Model\Service;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class AdminListPlaceTest extends DuskTestCase
{   
    use DatabaseMigrations;

    public function makeService($row)
    {
        factory(Service::class, $row)->create();
    }

    /**
     * A Dusk test show record with table empty.
     *
     * @return void
     */
    public function testListEmpty()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/service')
                ->assertSee('List service');
            $elements = $browser->elements('#table-contain tbody tr');
            $this->assertCount(0, $elements);
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
        $this->makeService(9);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/service')
                ->resize(1920, 2000)
                ->assertSee('List service');
            $elements = $browser->elements('#table-contain tbody tr');
            $this->assertCount(9, $elements);
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
        $this->makeService(21);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/service')
                ->resize(1920, 2000)
                ->assertSee('List service');

            $elements = $browser->elements('#table-contain tbody tr');
            $this->assertCount(10, $elements);
            $this->assertNotNull($browser->element('.pagination'));

            //Count page number of pagination
            $paginateElement = $browser->elements('.pagination li');
            $numberPage = count($paginateElement) - 2;
            $this->assertTrue($numberPage == 3);
        });
    }

    /**
     * Test click page 2 in pagination link
     *
     * @return void
     */
    public function testPathPagination()
    {   
        $this->makeService(12);
        $this->browse(function (Browser $browser) {
            $page = $browser->visit('/admin/service');
            $page->click('.pagination li:nth-child(3) a');
            $elements = $page->elements('#table-contain tbody tr');
            $this->assertCount(2, $elements);
            $browser->assertPathIs('/admin/service');
            $browser->assertQueryStringHas('page', 2);
        });
    }
}
