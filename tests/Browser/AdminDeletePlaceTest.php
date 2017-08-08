<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\Place;
use Illuminate\Support\Facades\DB;

class AdminDeletePlaceTest extends DuskTestCase
{   
    use DatabaseMigrations;

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
    {   DB::table('reservations','hotel_services', 'rooms', 'hotels', 'places')
            ->truncate();
        $result = factory(Place::class, 3)->create();
         
        $this->assertEquals(3, count($result));
    }
}
