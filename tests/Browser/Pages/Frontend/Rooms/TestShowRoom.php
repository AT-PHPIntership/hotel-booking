<?php

namespace Tests\Browser\Pages\Frontend\Rooms;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\Room;
use App\Model\Reservation;
use App\Model\Hotel;
use App\Model\Place;
use App\Model\Guest;
use App\Model\User;
use Faker\Factory as Faker;

class TestShowRoom extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test modal show room.
     *
     * @return void
     */
    public function testShowRoomIfHotelHasRoom()
    {
        $this->makeData(5);
        $hotel = Hotel::find(1);
        $this->makeRoom($hotel->id);
        $this->browse(function (Browser $browser) use ($hotel){
            $selector = 'main section:nth-child(2) .container .row div:nth-child(2) .room-thumb .mask .content';
            $page = $browser->visit('/')
                    ->clickLink('Hotels')
                    ->mouseover($selector)
                    ->whenAvailable($selector, function ($selectorAvailable) {
                        $selectorAvailable->click('.btn');
                    })
                    ->assertSee($hotel->name)
                    ->assertPathIs('/hotels/'.$hotel->slug);
                $browser->clickLink('Room information')
                        ->pause(3000)
                        ->assertVisible('#room-detail-modal-'.$hotel->rooms[0]->id);
        });
    }

    /**
     * Test if hotel has not room.
     *
     * @return void
     */
    public function testIfHotelHasNotRoom()
    {
        $this->makeData(5);
        $hotel = Hotel::find(1);
        $this->browse(function (Browser $browser) use ($hotel){
            $selector = 'main section:nth-child(2) .container .row div:nth-child(2) .room-thumb .mask .content';
            $page = $browser->visit('/')
                    ->clickLink('Hotels')
                    ->mouseover($selector)
                    ->whenAvailable($selector, function ($selectorAvailable) {
                        $selectorAvailable->click('.btn');
                    })
                    ->assertSee($hotel->name)
                    ->assertDontSee('Room information')
                    ->assertSee('Hotel not has room any ! Admin is updating !')
                    ->assertPathIs('/hotels/'.$hotel->slug);
        });
    }

    /**
     * Test Value of page show detail room.
     *
     * @return void
     */
    public function testShowValueOfDetailRoom()
    {
        $this->makeData(10);
        $hotel = Hotel::find(1);
        $this->makeRoom($hotel->id);
        $this->browse(function (Browser $browser) use ($hotel) {
            $selector = 'main section:nth-child(2) .container .row div:nth-child(2) .room-thumb .mask .content';
            $page = $browser->visit('/')
                    ->clickLink('Hotels')
                    ->mouseover($selector)
                    ->whenAvailable($selector, function ($selectorAvailable) {
                        $selectorAvailable->click('.btn');
                    })
                    ->assertSee($hotel->name)
                    ->assertPathIs('/hotels/'.$hotel->slug);
            $browser->clickLink('Room information')
                    ->pause(2000);
            $this->assertTrue($browser->text('.room-detail-info ul li:nth-child(1)') === 'Room name: '.$hotel->rooms[0]->name);
            $this->assertTrue($browser->text('.room-detail-info ul li:nth-child(2)') === 'Quantity: '.(string)($hotel->rooms[0]->total-$hotel->rooms[0]->quantity_busy_reservation));
            $this->assertTrue($browser->text('.room-detail-info ul li:nth-child(3)') === 'Bed: '.$hotel->rooms[0]->bed);
            $this->assertTrue($browser->text('.room-detail-info ul li:nth-child(4)') === 'Direction: '.$hotel->rooms[0]->direction);
            $this->assertTrue($browser->text('.room-detail-info ul li:nth-child(5)') === 'Max guest: '.$hotel->rooms[0]->max_guest);
            $this->assertTrue($browser->text('.room-detail-info ul li:nth-child(6)') === 'Descript: '.$hotel->rooms[0]->descript);
            $this->assertTrue($browser->text('.cls-room-price') === $hotel->rooms[0]->price.' $');
        });
    }

    /**
     * Test close modal show room.
     *
     * @return void
     */
    public function testCloseModalShowRoom()
    {
        $this->makeData(10);
        $hotel = Hotel::find(1);
        $this->makeRoom($hotel->id);
        $this->browse(function (Browser $browser) use ($hotel) {
            $selector = 'main section:nth-child(2) .container .row div:nth-child(2) .room-thumb .mask .content';
            $page = $browser->visit('/')
                    ->clickLink('Hotels')
                    ->mouseover($selector)
                    ->whenAvailable($selector, function ($selectorAvailable) {
                        $selectorAvailable->click('.btn');
                    })
                    ->assertSee($hotel->name)
                    ->assertPathIs('/hotels/'.$hotel->slug);
                $browser->clickLink('Room information')
                        ->pause(3000)
                        ->press('BACK')
                        ->assertDontSee('.modal-body')
                        ->assertPathIs('/hotels/'.$hotel->slug);
        });
    }

    /**
     * Make data for test.  
     *
     * @return void
     */
    public function makeData($row)
    {   
        factory(Place::class, $row)->create();
        factory(User::class, $row)->create();
        factory(Guest::class, $row)->create();
        $placeIds = Place::all('id')->pluck('id')->toArray();
        $faker = Faker::create();
        factory(Hotel::class, 1)->create([
            'place_id' => $faker->randomElement($placeIds)
        ]);
    }

    /**
     * Make room of hotel
     */
    public function makeRoom($hotelId) {
        
        $hotelIds = Hotel::all('id')->pluck('id')->toArray();
            factory(Room::class, 1)->create([
                'hotel_id' => $hotelId,
                'bed' => 'single',
                'direction' => 'Floor Two',
            ]);
    }
}
