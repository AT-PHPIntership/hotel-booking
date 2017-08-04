<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ListHotelTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testContent()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/hotel')
                    ->assertSee('Hotel')
                    ->assertTitle('Admin | List hotels');
        });
    }

     /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testClickRoute()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin')
                    ->click('#bt-hotel')
                    ->assertPathIs('/admin/hotel')
                    ->screenshot(1);
        });
    }

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testAddButton()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/hotel')
                    ->assertSee('Hotel')
                    ->assertTitle('Admin | List hotels');
        });
    }
}
