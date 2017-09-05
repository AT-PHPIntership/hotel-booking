<?php

namespace Tests\Browser\Pages\Backend\Users;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\Room;
use App\Model\Hotel;
use App\Model\Place;
use Faker\Factory as Faker;

class AdminSearchRoomTest extends DuskTestCase
{
   use DatabaseMigrations;

    /**
     * Make rooms for hotel
     */
    public function makeRoomOfHotel($idHotel, $row)
    {
        factory(Place::class, 5)->create();
        $placeIds = Place::all('id')->pluck('id')->toArray();
        $faker = Faker::create();
        for ($i = 0; $i < $idHotel; $i++) {
            factory(Hotel::class, 1)->create([
                'place_id' => $faker->randomElement($placeIds)
            ]);
        }
        for ($i = 0; $i < $row; $i++) {
            Room::create([
                'name' => 'name' . $i,
                'descript' => 'descript' . $i,
                'bed' => 'bed' . $i,
                'direction' => 'direction' . $i,
                'price' => $i,
                'total' => $i,
                'max_guest' => $i,
                'size' => $i,
                'hotel_id' => 1,
            ]);
        }
    }

    /**
     *Test search if not input value.
     *
     * @return void
     */
    public function testSearchNotInputValue()
    {
        $this->makeRoomOfHotel(1, 10);   
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/hotel/1/room')
                    ->press('.btn-search')
                    ->assertPathIs('/admin/hotel/1/room')
                    ->assertTitle('Admin | Room')
                    ->assertSee('List Rooms');
            $elements = $browser->elements('#table-contain tbody tr');
            $browser->press('.btn-search');
            $this->assertCount(10, $elements);  
        });
    }

    /**
     *Test search if has input value and not paginate.
     *
     * @return void
     */
    public function testSearchHasInputValue()
    {
 
        $this->makeRoomOfHotel(1, 10);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/hotel/1/room')
                    ->type('search', 'name2')
                    ->press('.btn-search')
                    ->assertPathIs('/admin/hotel/1/room')
                    ->assertTitle('Admin | Room')
                    ->assertSee('List Rooms')
                    ->assertQueryStringHas('search', 'name2');
            $elements = $browser->elements('#table-contain tbody tr');
            $this->assertCount(1, $elements);
            $this->assertNull($browser->element('.pagination'));
        });
    }

     /**
     *Test search if has input value return and paginate.
     *
     * @return void
     */
    public function testSearchHasInputValuePaginate()
    {
 
        $this->makeRoomOfHotel(1, 22);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/hotel/1/room')
                    ->type('search', 'name1')
                    ->press('.btn-search')
                    ->assertPathIs('/admin/hotel/1/room')
                    ->assertTitle('Admin | Room')
                    ->assertSee('List Rooms')
                    ->assertQueryStringHas('search', 'name1');
            $elements = $browser->elements('#table-contain tbody tr');
            $this->assertCount(10, $elements);
            $this->assertNotNull($browser->element('.pagination'));
            $browser->click('.pagination li:nth-child(3) a');
            $elements = $browser->elements('#table-contain tbody tr');
            $this->assertCount(1, $elements);
            $browser->assertPathIs('/admin/hotel/1/room')
                    ->assertTitle('Admin | Room');
            $browser->assertQueryStringHas('page', 2);
        });
    }


    /**
     *Test search has input value but not found.
     *
     * @return void
     */
    public function testSearchNotResult()
    {
        $this->makeRoomOfHotel(1, 10);
        $this->browse(function (Browser $browser) {
            
            $browser->visit('/admin/hotel/1/room')
                    ->type('search', 'name11')
                    ->press('.btn-search')
                    ->assertPathIs('/admin/hotel/1/room')
                    ->assertTitle('Admin | Room')
                    ->assertSee('List Rooms')
                    ->assertQueryStringHas('search', 'name11');
            $elements = $browser->elements('#table-contain tbody tr');
            $numAccounts = count($elements);
            $this->assertCount(0, $elements);
            $browser->assertSee('Data Not Found');
            $this->assertNull($browser->element('.pagination'));
        });
    }
}
