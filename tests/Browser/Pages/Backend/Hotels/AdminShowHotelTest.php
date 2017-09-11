<?php

namespace Tests\Browser\Pages\Backend\Hotels;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\Place;
use App\Model\Hotel;
use App\Model\Room;
use Faker\Factory as Faker;

class AdminShowHotelTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test Value In Show Page.
     *
     * @return void
     */
    public function testShowHotel()
    {
        $this->makeData(5);
        $hotel = Hotel::find(4);
        $place = Place::find($hotel->place_id);
        $hotelIds = Hotel::all('id')->pluck('id')->toArray();
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            factory(Room::class, 1)->create([
                'hotel_id' => $faker->randomElement($hotelIds),
            ]);
        }
        $totalRooms = $hotel->rooms->count();
        $this->browse(function (Browser $browser) use ($hotel, $place, $totalRooms) {
            $browser->visit('/admin/hotel')
                    ->press('#table-contain tbody tr:nth-child(2) td:nth-child(2) a')
                    ->assertPathIs('/admin/hotel/'.$hotel->id)
                    ->assertSee('Hotel detail')
                    ->assertSee('Services')
                    ->assertSee('Address: '.$hotel->address)
                    ->assertSee('Introduce:'.$hotel->introduce)
                    ->assertSee('Place: '.$place->name)
                    ->assertSee('Total rooms: '.$totalRooms.'.');
        });
    }

    /**
     * Test Button Edit
     *
     * @return void
     */
    public function testButtonEdit()
    {
        $this->makeData(5);
        $hotel = Hotel::find(4);
        $this->browse(function (Browser $browser) use ($hotel) {
            $browser->visit('/admin/hotel')
                    ->press('#table-contain tbody tr:nth-child(2) td:nth-child(2) a')
                    ->assertPathIs('/admin/hotel/'.$hotel->id)
                    ->assertSee('Hotel detail')
                    ->clickLink('Edit hotel')
                    ->assertPathIs('/admin/hotel/'.$hotel->id.'/edit');
        });
    }

    /**
     * Test Button Back
     *
     * @return void
     */
    public function testButtonBack()
    {
        $this->makeData(5);
        $hotel = Hotel::find(4);
        $this->browse(function (Browser $browser) use ($hotel) {
            $browser->visit('/admin/hotel')
                    ->press('#table-contain tbody tr:nth-child(2) td:nth-child(2) a')
                    ->assertPathIs('/admin/hotel/'.$hotel->id)
                    ->assertSee('Hotel detail')
                    ->clickLink('Back')
                    ->assertPathIs('/admin/hotel')
                    ->assertSee('List of hotels');
        });
    }

    /**
     * Test 404 Page Not found when show hotel not exists.
     *
     * @return void
     */
    public function test404Page()
    {   
        $this->makeData(5);
        $hotel = Hotel::find(4);
        $this->browse(function (Browser $browser) use ($hotel) {
            $browser->visit('/admin/hotel')
                    ->assertSee('List of hotels');
            $hotel->delete();
            $browser->press('#table-contain tbody tr:nth-child(2) td:nth-child(2) a');
            $browser->assertSee('404 - Page Not found');
        });
    }

    /**
     * Make data for test.
     *
     * @return void
     */
    public function makeData($row)
    {   
        factory(Place::class, 10)->create();
        $placeIds = Place::all('id')->pluck('id')->toArray();
        $faker = Faker::create();
        for ($i = 0; $i < $row; $i++) {
            factory(Hotel::class, 1)->create([
                'place_id' => $faker->randomElement($placeIds),
                'address' => $faker->text
            ]);
        }
    }
}
