<?php

namespace Tests\Browser\Pages\Backend\Places;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\Room;
use App\Model\Place;
use App\Model\Hotel;
use App\Model\Image;
use Illuminate\Http\UploadedFile;
use Faker\Factory as Faker;

class AdminShowRoomTest extends DuskTestCase
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
            factory(Room::class, 1)->create([
                'hotel_id' => $idHotel,
            ]);
        }
    }
    
    /**
     * Make images for room
     */
    public function makeImagesOfRoom($idRoom, $row)
    {
        if (Room::find($idRoom) != null) {
            for ($i = 0; $i < $row; $i++) {
                Image::create([
                    'target' => 'room',
                    'target_id' => $idRoom,
                    'path' => 'path' . $i,
                ]);
            }
        }
    }

    /**
     * Test admin show detail room
     *
     * @return void
     */
    public function testShowDetailRoom()
    {
        $this->makeRoomOfHotel(1, 5);
        $this->makeImagesOfRoom(4, 3);
        $this->browse(function (Browser $browser) {
            $room = Room::with('images')->find(4);
            $hotel = Hotel::find(1);
            $browser->visit('/admin/hotel/1/room')
                    ->assertPathIs('/admin/hotel/1/room')
                    ->assertTitle('Admin | Room')
                    ->assertSee('List Rooms')
                    ->press('#table-contain tbody tr:nth-child(2) td:nth-child(3) a')
                    ->assertPathIs('/admin/hotel/1/room/' . $room->id)
                    ->assertTitle('Admin | SHOW ROOM')
                    ->assertSee('Room detail')
                    ->assertSeeIn('.col-md-7 h1', $room->name)
                    ->assertSeeIn('.col-md-7 h4 a', $hotel->name)
                    ->assertSeeIn('.col-md-7 h5:nth-child(3)', $room->descript)
                    ->assertSeeIn('.col-md-7 h5:nth-child(4)', $room->price)
                    ->assertSeeIn('.col-md-7 h5:nth-child(5)', 'Size:' . $room->size)
                    ->assertSeeIn('.col-md-7 h5:nth-child(6)', $room->total)
                    ->assertSeeIn('.col-md-7 h5:nth-child(7)', 'Bed:' . $room->bed)
                    ->assertSeeIn('.col-md-7 h5:nth-child(8)', 'Direction:' . $room->direction)
                    ->assertSeeIn('.col-md-7 h5:nth-child(9)', $room->max_guest);

            if (!isset($room->images[0])) {
                $imageElement = $browser->element('#myCarousel .carousel-inner .item img');
                $imageSrc = $imageElement->getAttribute('src');
                $this->assertTrue($imageSrc == asset(config('image.default_thumbnail')));
            } else {
                foreach ($room->images as $image) {
                    $imageElement = $browser->element('#myCarousel .carousel-inner .item:nth-child('. $image->id. ') img');
                    $imageSrc = $imageElement->getAttribute('src');
                    $this->assertTrue($imageSrc == asset($image->path));
                } 
            }
        });
    }

    /**
     * Test 404 Page when click url at room name because not found hotel of room .
     *
     * @return void
     */
    public function test404NotFoundHotelOfRoom()
    {   
        $this->makeRoomOfHotel(1, 5);
        $this->browse(function (Browser $browser) {
            $hotel = Hotel::find(1);
            $room = Room::with('images')->find(4);
            $browser->visit('/admin/hotel/1/room')
                    ->assertTitle('Admin | Room')
                    ->assertSee('List Rooms');
            $hotel->delete();
            $browser->press('#table-contain tbody tr:nth-child(2) td:nth-child(3) a');
            $browser->assertSee('404 - Page Not found');
        });
    }

    /** Test 404 Page when click url at room name because not found room .
     *
     * @return void
     */
    public function test404NotFoundRoom()
    {   
        $this->makeRoomOfHotel(1, 5);
        $this->browse(function (Browser $browser) {
            $room = Room::with('images')->find(4);
            $browser->visit('/admin/hotel/1/room')
                    ->assertTitle('Admin | Room')
                    ->assertSee('List Rooms');
            $room->delete();
            $browser->press('#table-contain tbody tr:nth-child(2) td:nth-child(3) a');
            $browser->assertSee('404 - Page Not found');
        });
    }

    /**
     * Test Button Back
     *
     * @return void
     */
    public function testBtnBack()
    {   
        $this->makeRoomOfHotel(1, 5);
        $this->browse(function (Browser $browser) {
            $room = Room::with('images')->find(4);
            $browser->visit('/admin/hotel/1/room')
                    ->assertTitle('Admin | Room')
                    ->assertSee('List Rooms')
                    ->press('#table-contain tbody tr:nth-child(2) td:nth-child(3) a')
                    ->assertPathIs('/admin/hotel/1/room/' . $room->id)
                    ->assertTitle('Admin | SHOW ROOM')
                    ->assertSee('Room detail')
                    ->clickLink('Back')
                    ->assertPathIs('/admin/hotel/1/room');
        });
    }

     /**
     * Test Button Edit
     *
     * @return void
     */
    public function testBtnEdit()
    {   
        $this->makeRoomOfHotel(1, 5);
        $this->browse(function (Browser $browser) {
            $room = Room::with('images')->find(4);
            $browser->visit('/admin/hotel/1/room')
                    ->assertTitle('Admin | Room')
                    ->assertSee('List Rooms')
                    ->press('#table-contain tbody tr:nth-child(2) td:nth-child(3) a')
                    ->assertPathIs('/admin/hotel/1/room/' . $room->id)
                    ->assertTitle('Admin | SHOW ROOM')
                    ->assertSee('Room detail')
                    ->clickLink('Edit room')
                    ->assertPathIs('/admin/hotel/1/room/' .$room->id . '/edit');
        });
    }
}
