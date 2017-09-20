<?php

namespace Tests\Browser\Pages\Frontend\Hotels;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\Hotel;
use App\Model\Room;
use App\Model\Reservation;
use App\Model\Place;
use Carbon\Carbon;

class UserSearchHotelTest extends DuskTestCase
{
   use DatabaseMigrations;

    /**
     * Test Validation Search Hotel.
     *
     * @return void
     */
    public function testValidation()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/hotels')
                    ->press('SEARCH')
                    ->assertPathIs('/hotels')
                    ->assertSee('The hotel source area field is required.')
                    ->assertSee('The checkin field is required.');
        });
    }

    public function listCaseTestValidationForSearch()
    {
        return [
            [false, date('d/m/Y'), 'The hotel source area field is required.'],
            [true, '', 'The checkin field is required.']
        ];
    }

    /**
     * @dataProvider listCaseTestValidationForSearch
     */
    public function testSearchFailValidation(
        $hasPlace,
        $checkin,
        $expected
    ) {   

        $this->browse(function (Browser $browser) use (
            $hasPlace,
            $checkin,
            $expected
        ) {


            if ($hasPlace) {
                factory(Place::class, 1)->create();
            }
            $browser->visit('/hotels')
                    ->assertSee('List Hotels')
                    ->assertTitle('LIST HOTELS')
                    ->type('hotelSourceArea', '')
                    ->script(["document.querySelector('#checkin').value = '" . $checkin . "'"]);
            $browser->press('SEARCH')
                    ->assertPathIs('/hotels')
                    ->assertSee($expected);
        });
    }

    /**
     *Test search if has input value, has result and not paginate.
     *
     * @return void
     */
    public function testSearchHasInputValue()
    {
        //Make 11 hotels for place ad id = 1
        $this->makeHotels(1, 11);
        // Make 11 rooms from 11 hotels 
        $this->makeRooms(11, 1);
        $this->browse(function (Browser $browser) {
            $browser->visit('/hotels')
                    ->assertSee('List Hotels')
                    ->assertTitle('LIST HOTELS')
                    ->type('hotelSourceArea', '')
                    ->select('duration', 1)
                    ->script(["document.querySelector('#checkin').value = '" . date('m/d/Y') . "'"]);
            $browser->press('SEARCH')
                    ->assertInputValue('hotelSourceArea', Place::find(1)->name)
                    ->assertInputValue('checkin', date('m/d/Y'))
                    ->assertPathIs('/hotels');;
            $elements = $browser->elements('.rooms.mt50 .container .row .col-sm-4');
            $this->assertCount(11, $elements);
            $this->assertNull($browser->element('.pagination'));
        });
    }

     /**
     *Test search if has input value, has result and paginate.
     *
     * @return void
     */
    public function testSearchHasInputValuePaginate()
    {
        //Make 13 hotels for place ad id = 1
        $this->makeHotels(1, 13);
        // Make 13 rooms from 13 hotels 
        $this->makeRooms(13, 1);
        $this->browse(function (Browser $browser) {
            $browser->visit('/hotels')
                    ->assertSee('List Hotels')
                    ->assertTitle('LIST HOTELS')
                    ->type('hotelSourceArea', '')
                    ->select('duration', 1)
                    ->script(["document.querySelector('#checkin').value = '" . date('d/m/Y') . "'"]);
            $browser->press('SEARCH')
                    ->assertInputValue('hotelSourceArea', Place::find(1)->name)
                    ->assertInputValue('checkin', date('d/m/Y'))
                    ->assertPathIs('/hotels');
            $elements = $browser->elements('.rooms.mt50 .container .row .col-sm-4');
            $this->assertCount(12, $elements);
            $this->assertNotNull($browser->element('.pagination'));
        });
    }

    /**
     *Test search has input value but not found.
     *
     * @return void
     */
    public function testSearchNotResult()
    {
        //Make 1 hotels for place ad id = 1
        $this->makeHotels(1, 1);
        // Make 1 room from 1 hotel 
        $this->makeRooms(1, 1);
        // Change room of hotel to busy room
        $this->changeRoomToBusyRoom(1);
        $this->browse(function (Browser $browser) {
            $browser->visit('/hotels')
                    ->assertSee('List Hotels')
                    ->assertTitle('LIST HOTELS')
                    ->type('hotelSourceArea', '')
                    ->select('duration', 1)
                    ->script(["document.querySelector('#checkin').value = '" . date('d/m/Y') . "'"]);
            $browser->press('SEARCH')
                    ->assertInputValue('hotelSourceArea', Place::find(1)->name)
                    ->assertInputValue('checkin', date('d/m/Y'))
                    ->assertPathIs('/hotels');
            $elements = $browser->elements('.rooms.mt50 .container .row .col-sm-4');
            $this->assertCount(0, $elements);
            $this->assertNull($browser->element('.pagination'));
        });
    }

    /**
     * Make hotels of place has id = $idPlace
     */
    public function makeHotels($idPlace, $rowHotel)
    {
        factory(Place::class, $idPlace)->create();
        for ($i = 0; $i < $rowHotel; $i++) {
            factory(Hotel::class, 1)->create([
                'place_id' => $idPlace
            ]);
        }
    }

    /**
     * Make rooms of hotels has id from 1 to $idHotel
     */
    public function makeRooms($idHotel, $rowRoom)
    {
        for ($i = 1; $i <= $idHotel; $i++) {
            for ($j = 0; $j < $rowRoom; $j++) {
                factory(Room::class, 1)->create([
                    'hotel_id' => $i
                ]);
            }
        }
    }

    /**
     * Change room has id = $idRoom to busy room
     */
    public function changeRoomToBusyRoom($idRoom)
    {
        for ($i = 1; $i <= $idRoom; $i++) {
            factory(Reservation::class, 1)->create([
                'room_id' => $i,
                'quantity' => 100,
                'status' => 1,
                'checkin_date' => '2016-01-01 14:00:00',
                'checkout_date' => Carbon::createFromFormat('d/m/Y H:i:s', date('d/m/Y') . ' 11:00:00')
                    ->addDay(15)
                    ->toDateTimeString()
            ]);
        }
    }
}
