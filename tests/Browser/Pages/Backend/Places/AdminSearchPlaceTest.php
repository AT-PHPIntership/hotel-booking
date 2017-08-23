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
        $this->makePlace(10);
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
        Place::create([
            'name' => 'Da Nang',
            'descript' => 'City of Viet Nam',
            'image' => 'image.jpg',
        ]);

        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/place')
                    ->type('search', 'Da Nang')
                    ->press('.btn-search');
            $elements = $browser->elements('#table-contain tbody tr');
            $numAccounts = count($elements);
            $this->assertTrue($numAccounts == 1);   
        });
    }
    
    // /**
    //  *Test search has input value but not found.
    //  *
    //  * @return void
    //  */
    // public function testSearchNotResult()
    // {
    //     $this->makeData(10);
    //     $this->browse(function (Browser $browser) {     
    //         $browser->visit('/admin/news')
    //                 ->type('search', 'Nsdsad')
    //                 ->press('.btn-search');
    //         $elements = $browser->elements('#newstable tbody tr');
    //         $numAccounts = count($elements);
    //         $this->assertTrue($numAccounts == 0);
    //         $browser->assertSee('Data Not Found');
    //     });
    // }
    // /**
    //  *Test search has input value and has many record.
    //  *
    //  * @return void
    //  */
    // public function testHasManyRecord()
    // {
    //     $this->makeData(15);
    //     $this->browse(function (Browser $browser) {
    //         $browser->visit('/admin/news')
    //                 ->type('search', 'News')
    //                 ->press('.btn-search');
    //         $elements = $browser->visit('/admin/news?search=News&page=1')
    //                             ->elements('#newstable tbody tr');
    //         $numAccounts = count($elements);
    //         $this->assertTrue($numAccounts == 10);
    //         $browser->assertPathIs('/admin/news')
    //                 ->assertQueryStringHas('search', 'News')
    //                 ->assertQueryStringHas('page', '1');
    //         $elements = $browser->visit('/admin/news?search=News&page=2')
    //                             ->elements('#newstable tbody tr');
    //         $numAccounts = count($elements);
    //         $this->assertTrue($numAccounts == 5);
    //         $browser->assertPathIs('/admin/news')
    //                 ->assertQueryStringHas('search', 'News')
    //                 ->assertQueryStringHas('page', '2');
    //     }); 
    // }

    /**
     * Making place on database
     *
     * @param  int $row number of row on table
     *
     * @return void
     */
    public function makePlace($row)
    {
         factory(Place::class, $row )->create();
    }
}