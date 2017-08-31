<?php

namespace Tests\Browser\Pages\Backend\Places;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\Place;
use App\Model\Hotel;
use Faker\Factory as Faker;

class AdminDeletePlaceTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test route to place page.
     *
     * @return void
     */
    public function testVisitAdminPlace()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin')
                ->click('#place')
                ->assertPathIs('/admin/place')
                ->assertTitleContains('Place');
        });
    }

    /**
     * Test delete place success
     *
     * @return void
     */
    public function testDeleteSuccess() 
    {
        $this->makePlace(5);
        $this->browse(function (Browser $browser) {
            $page = $browser->visit('/admin/place');
            $elements = $page->elements('#table-contain tbody tr');
            $this->assertCount(5, $elements);
            $page->press('#table-contain tbody tr:nth-child(4) td:nth-child(4) button')
            ->waitForText("Confirm deletion!")
            ->press('Delete')
            ->assertSee("Delete success");
            $this->assertSoftDeleted('places', ['id' => '2']);
            $elements = $page->elements('#table-contain tbody tr');    
            $this->assertCount(4, $elements);    
        });
    } 

    /**
     * Test not found place
     *
     * @return void
     */
    public function testNotFound()
    {   
        $this->makePlace(5);
        $this->browse(function (Browser $browser) {
            $page = $browser->visit('/admin/place');
            $place = Place::find(2);
            $place->delete();
            $page->press('#table-contain tbody tr:nth-child(4) td:nth-child(4) button')
                ->waitForText("Confirm deletion!")
                ->press('Delete')
                ->assertSee("404 - Page Not found");
        });  
    }

    /**
     * 
     * Test delete hotel belong to place
     * 
     * @return void
     */
    public function testDeleteRelationship()
    {
        $this->makePlace(1);
        $placeIds = Place::all('id')->pluck('id')->toArray();
        $faker = Faker::create();
        for ($i = 0; $i < 5; $i++) {
            $hotel = factory(Hotel::class, 1)->create([
                'place_id'=> '1'
            ]);
        }
        $place = Place::find(1);
        $hotels = $place->hotels()->get();
        $this->assertCount(5, $hotels);
        $this->browse(function (Browser $browser) {
            $page = $browser->visit('/admin/place');
            $page->press('#table-contain tbody tr:nth-child(1) td:nth-child(4) button')
            ->waitForText("Confirm deletion!")
            ->press('Delete')
            ->assertSee("Delete success");
        });
        $hotels = $place ->hotels()->get(); 
        $this->assertCount(0, $hotels);
    }

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
