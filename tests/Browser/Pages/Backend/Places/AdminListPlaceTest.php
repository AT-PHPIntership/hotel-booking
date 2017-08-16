<?php

namespace Tests\Browser\Backend\Places;

use App\Model\Place;
use App\Model\User;
use Tests\TestCase;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class AdminListPlaceTest extends DuskTestCase
{   
    use DatabaseMigrations;
    /**
     * A Dusk test URL admin place.
     *
     * @return void
     */
    public function testURL()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin')
            ->click('#place')
            ->assertPathIs('/admin/place')
            ->assertPathIsNot('/home');
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
            $browser->visit('/admin/place')
                ->assertSee('List place');
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
        factory(Place::class, 9)->create();
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/place')
                ->resize(1920, 2000)
                ->assertSee('List place');
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
        factory(Place::class, 21)->create();
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/place')
                ->resize(1920, 2000)
                ->assertSee('List place');
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
        factory(Place::class, 12)->create();
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/place?page=2');
            $elements = $browser->elements('#table-contain tbody tr');
            $this->assertCount(2, $elements);
            $browser->assertPathIs('/admin/place');
            $browser->assertQueryStringHas('page', 2);
        });
    }
}
