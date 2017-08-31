<?php

namespace Tests\Browser\Backend\Feedbacks;

use App\Model\Feedback;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class AdminListFeedbackTest extends DuskTestCase
{   
    use DatabaseMigrations;

    public function makeData($row)
    {
        factory(Feedback::class, $row)->create();
    }

    /**
     * A Dusk test show record with table empty.
     *
     * @return void
     */
    public function testListEmpty()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/feedback')
                ->assertSee('List feedback');
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
        $this->makeData(9);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/feedback')
                ->resize(1920, 2000)
                ->assertSee('List feedback');
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
        $this->makeData(21);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/feedback')
                ->resize(1920, 2000)
                ->assertSee('List feedback');

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
        $this->makeData(12);
        $this->browse(function (Browser $browser) {
            $page = $browser->visit('/admin/feedback');
            $page->click('.pagination li:nth-child(3) a');
            $elements = $page->elements('#table-contain tbody tr');
            $this->assertCount(2, $elements);
            $browser->assertPathIs('/admin/feedback');
            $browser->assertQueryStringHas('page', 2);
            
            $paginateActive = $browser->text('.pagination .active span');
            $this->assertTrue($paginateActive == '2'); 

            $paginateElement = $browser->elements('.pagination li');
            $numberPage = count($paginateElement) - 2;
            $this->assertTrue($numberPage == 2);
        });
    }
}
