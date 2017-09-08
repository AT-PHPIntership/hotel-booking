<?php

namespace Tests\Browser\Pages\Backend\Rooms;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\Room;
use App\Model\Hotel;
use App\Model\Place;
use Faker\Factory as Faker;

class AdminDeleteRoomTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test success when click delete button.
     *
     * @return void
     */
    public function testDeleteSuccess()
    {
        $this->makeRoomOfHotel(1, 5);
        $this->browse(function (Browser $browser) {           
            $page = $browser->visit('/admin/hotel/1/room');
            $elements = $page->elements('#table-contain tbody tr');
            $this->assertCount(5, $elements);
            $page->press('#table-contain tbody tr:nth-child(2) td:nth-child(7) button')
                 ->waitForText('Confirm deletion!')
                 ->click('#delete-btn')
                 ->assertSee("Deletion successful!");
            $this->assertSoftDeleted('rooms', ['id' => '4']);    
            $elements = $page->elements('#table-contain tbody tr');
            $page->assertDontSeeIn('#table-contain tbody tr:nth-child(2) td:nth-child(1)', 4)
                 ->assertPathIs('/admin/hotel/1/room');   
            $this->assertCount(4, $elements);  
        });
    }

    /**
     * Test 404 Page Not found when delete room and not find room.
     *
     * @return void
     */
    public function test404PageForRoom()
    {   
        $this->makeRoomOfHotel(1, 5);
        $room = Room::find(4);
        $this->browse(function (Browser $browser) use ($room) {
            $browser->visit('/admin/hotel/1/room')
                    ->assertSee('List Rooms')
                    ->press('#table-contain tbody tr:nth-child(2) td:nth-child(7) button');
            $room->delete();
            $browser->waitForText('Confirm deletion!')
                    ->click('#delete-btn')
                    ->assertSee('404 - Page Not found');
        });
    }

    /**
     * Test 404 Page Not found when delete room and not find hotel.
     *
     * @return void
     */
    public function test404PageForHotel()
    {   
        $this->makeRoomOfHotel(1, 5);
        $hotel = Hotel::find(1);
        $this->browse(function (Browser $browser) use ($hotel) {
            $browser->visit('/admin/hotel/1/room')
                    ->assertSee('List Rooms')
                    ->press('#table-contain tbody tr:nth-child(2) td:nth-child(7) button');
            $hotel->delete();
            $browser->waitForText('Confirm deletion!')
                    ->click('#delete-btn')
                    ->assertSee('404 - Page Not found');
        });
    }

    /**
     * Make $row rooms for hotel which has id = $idHotel
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
            factory(Room::class, 1)->create([
                'hotel_id' => $idHotel,
            ]);
        }
    }
}
