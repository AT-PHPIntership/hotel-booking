<?php

namespace Tests\Browser\Pages\Backend\Services;

use App\Model\Service;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminSearchServiceTest extends DuskTestCase
{
     use DatabaseMigrations;

    /**
     *Test search if not input value.
     *
     * @return void
     */
    public function testSearchNotInputValue()
    {
        $this->makeData(10);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/service')
                ->press('.btn-search')
                ->assertPathIs('/admin/service')
                ->assertQueryStringMissing('search');
        });
    }

    /**
     *Test search if has input value and has one record.
     *
     * @return void
     */
    public function testSearchHasInputValue()
    {
        $this->makeData(9);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/service')
                ->type('search', 'Service 1')
                ->press('.btn-search')
                ->assertPathIs('/admin/service')
                ->assertQueryStringHas('search', 'Service 1');
            $elements = $browser->elements('#table-contain tbody tr');
            $this->assertCount(1, $elements);
        });
    }
    
    /**
     *Test search has input value but not found.
     *
     * @return void
     */
    public function testSearchNotResult()
    {
        $this->makeData(10);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/service')
                ->type('search', 'Wifi')
                ->press('.btn-search')
                ->assertPathIs('/admin/service')
                ->assertQueryStringHas('search', 'Wifi');
            $elements = $browser->elements('#table-contain tbody tr');
            $this->assertCount(0, $elements);
            $browser->assertSee('Data Not Found');
        });
    }

    /**
     *Test search has input value and has many record.
     *
     * @return void
     */
    public function testHasManyRecord()
    {
        $this->makeData(15);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/service')
                ->type('search', 'Service')
                ->press('.btn-search')
                ->assertPathIs('/admin/service')
                ->assertQueryStringHas('search', 'Service');
            
            $elements = $browser->elements('#table-contain tbody tr');
            $this->assertCount(10, $elements);

            //assert paginate is exist and current page paginate is 1
            $paginateActive = $browser->text('.pagination .active span');
            $this->assertTrue($paginateActive == '1'); 

            $page = $browser->click('.pagination li:nth-child(3) a');
            $page->assertPathIs('/admin/service')
                ->assertQueryStringHas('search', 'Service')
                ->assertQueryStringHas('page', 2);
                
            $elements = $page->elements('#table-contain tbody tr');
            $this->assertCount(5, $elements);
            $paginateActive = $browser->text('.pagination .active span');
            $this->assertTrue($paginateActive == '2'); 
        }); 
    }

     /**
     * Make data for test
     *
     * @return void
     */
    public function makeData($row)
    {
        for ($i = 1; $i <= $row ; $i++) { 
            Service::create([
                'name' => 'Service ' . $i,
            ]);
        }
    }
}
