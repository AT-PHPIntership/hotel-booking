<?php

namespace Tests\Browser\Pages\Backend\Places;

use App\Model\Place;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminSearchPlaceTest extends DuskTestCase
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
            $browser->visit('/admin/place')
                ->press('.btn-search')
                ->assertPathIs('/admin/place')
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
            $browser->visit('/admin/place')
                ->type('search', 'Place 1')
                ->press('.btn-search');
            $elements = $browser->elements('#table-contain tbody tr');
            $numAccounts = count($elements);
            $this->assertTrue($numAccounts == 1);
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
            $browser->visit('/admin/place')
                ->type('search', 'asdfghjkl;')
                ->press('.btn-search');
            $elements = $browser->elements('#table-contain tbody tr');
            $numAccounts = count($elements);
            $this->assertTrue($numAccounts == 0);
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
            $browser->visit('/admin/place')
                ->type('search', 'Place')
                ->press('.btn-search');
            
            $elements = $browser->elements('#table-contain tbody tr');
            $totalRow = count($elements);
            $this->assertTrue($totalRow == 10);

            //assert paginate is exist and current page paginate is 1
            $paginateActive = $browser->text('.pagination .active span');
            $this->assertTrue($paginateActive == '1'); 

            $page = $browser->click('.pagination li:nth-child(3) a');
            $page->assertPathIs('/admin/place')
                ->assertQueryStringHas('search', 'Place')
                ->assertQueryStringHas('page', 2);
                
            $elements = $page->elements('#table-contain tbody tr');
            $totalRow = count($elements);
            $this->assertTrue($totalRow == 5);
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
            Place::create([
                'name' => 'Place ' . $i,
                'descript' => 'Descript '. $i,
                'image' => 'image'. $i . '.jpg'
            ]);
        }
    }
}
