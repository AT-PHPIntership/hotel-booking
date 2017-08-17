<?php

namespace Tests\Browser\Pages\Backend\Places;

use App\Model\Place;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Http\Request;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminUpdatePlaceTest extends DuskTestCase
{
    use DatabaseMigrations;


    public function setUp()
    {
        parent::setUp();
        factory(Place::class, 5)->create();
    }
    /**
     * Test URL admin edit place page
     *
     * @return void
     */
    public function testUrlAdminEditPlace()
    {   $place = Place::find(5);
        $this->browse(function (Browser $browser) use ($place) {
            $browser->visit('/admin/place')
                ->press('#table-contain tbody tr:nth-child(1) td:nth-child(5) a')
                ->assertPathIs('/admin/place/'.$place->id.'/edit')
                ->assertSee('Update place');
        });
    }

    /**
     * Test value for each input in edit form.
     *
     * @return void
     */
    public function testValueEditPlace()
    {
        $this->browse(function (Browser $browser)  {
            $place = Place::find(1);
            $browser->visit('/admin/place')
                ->press('#table-contain tbody tr:nth-child(5) td:nth-child(5) a')
                ->assertPathIs('/admin/place/'.$place->id.'/edit')
                ->assertSee('Update place')
                ->assertInputValue('name', $place->name)
                ->assertInputValue('descript', $place->descript);
                $a = __FILE__;
               

                echo $a;
                // ->assertInputValue('image', $place->descript);
                // ->assertNotNull('image', $place->image_url);
        });
    }

}
