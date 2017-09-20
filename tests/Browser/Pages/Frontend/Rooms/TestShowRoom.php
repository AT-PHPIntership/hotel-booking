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
    public function testShowRoom()
    {
        $this->makeData(20);
        $this->browse(function (Browser $browser) {
            $hotel = Hotel::find(20);
            $selector = 'main section:nth-child(2) .container .row div:nth-child(2) .room-thumb .mask .content';
            $browser->visit('/')
                    ->clickLink('Hotels')
                    ->mouseover($selector)
                    ->whenAvailable($selector, function ($selectorAvailable) {
                        $selectorAvailable->click('.btn');
                    })
                    ->assertSee($hotel->name)
                    ->assertPathIs('/hotels/'.$hotel->slug);
            if ($hotel->rooms->count() != 0) {
                $browser->assertVisible('room-item');
            } else {
                $browser->assertSee('Hotel not has room any ! Admin is updating !');
            }
            
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
        $hotelIds = Hotel::all('id')->pluck('id')->toArray();
            factory(Room::class, 1)->create([
                'hotel_id' => $faker->randomElement($hotelIds),
            ]);
        $roomIds = Room::all('id')->pluck('id')->toArray();
        for ($i = 0; $i < $row; $i++) {
            factory(Reservation::class, 1)->create([
                'room_id' => $faker->randomElement($roomIds),
            ]);
        }
    }
}
