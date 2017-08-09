<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Session;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Model\Place;
use Illuminate\Support\Facades\DB;

class AdminDeletePlaceTest extends DuskTestCase
{   
    use DatabaseTransactions;

    /**
     * A Dusk test route to page.
     *
     * @return void
     */
    public function testClickRoute()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin')
                ->click('#place')
                ->assertPathIs('/admin/place')
                ->assertTitleContains('Place')
                ->screenshot(1);
        });
    }

    public function testHasRecord()
    {   
        // Session::start();
        $result = $this->makeData(10);
         
        $this->assertEquals(10, count($result));
    }

    public function testDeleteSuccess() {

        $this->browse(function (Browser $browser) {
            $this->makeData(10);
            $place = Place::find(2);
            $browser->visit('/admin/place')
                ->press('#place_'.$place->id)
                ->acceptDialog()
                ->assertSee("Delete successfully")
                ->screenshot(2);
        });
    } 

    public function makeData($row) {
        DB::statement("SET foreign_key_checks=0");
        Place::truncate();
        DB::statement("SET foreign_key_checks=1");
        $result = factory(Place::class, $row)->create();
        return $result;
    }  
}
