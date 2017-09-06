<?php

namespace Tests\Browser\Pages\Backend\Rooms;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\Room;
use App\Model\Place;
use App\Model\Hotel;
use App\Model\Image;
use Illuminate\Http\UploadedFile;
use Faker\Factory as Faker;

class AdminUpdateRoomTest extends DuskTestCase
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
     * Test value for each input in edit form.
     *
     * @return void
     */
    public function testValueEditRoom()
    {
        $this->makeRoomOfHotel(1, 5);
        $this->makeImagesOfRoom(4, 3);
        $this->browse(function (Browser $browser)  {
            $room = Room::with('images')->find(4);
            $page = $browser->visit('/admin/hotel/1/room')
                ->press('#table-contain tbody tr:nth-child(2) td:nth-child(7) a')
                ->assertPathIs('/admin/hotel/1/room/' . $room->id . '/edit')
                ->assertTitle('Admin | UPDATE ROOM')
                ->assertSee('Update room')
                ->assertInputValue('name', $room->name)
                ->assertInputValue('descript', $room->descript)
                ->assertInputValue('price', $room->price)
                ->assertInputValue('size', $room->size)
                ->assertInputValue('total', $room->total)
                ->assertInputValue('bed', $room->bed)
                ->assertInputValue('direction', $room->direction)
                ->assertInputValue('max_guest', $room->max_guest);
            foreach ($room->images as $image) {
                $oldImage = $page->element('#old-img-' . $image->id . ' .img-place');
                $imageSrc = $oldImage->getAttribute('src');
                $this->assertTrue($imageSrc == asset($image->path));
            }  
        });
    }

        /**
     * Cases of test value image
     *
     * @return array
     */
    public function listCaseTestValueImage()
    {   
        $image = $this->fakeFile(true);
        return [
            [$image],
            ['']
        ];
    }

    /**
     * Test admin update room success.
     *
     * @dataProvider listCaseTestValueImage
     *
     * @return void
     */
    public function testUpdatesRoomSuccess($image)
    {
        $this->makeRoomOfHotel(1, 5);
        $this->makeImagesOfRoom(4, 3);
        $this->browse(function (Browser $browser) use ($image) {
            $room = Room::with('images')->find(4);
            $firstOldImage = $room->images[0];
            $page = $browser->visit('/admin/hotel/1/room')
                ->press('#table-contain tbody tr:nth-child(2) td:nth-child(7) a')
                ->assertPathIs('/admin/hotel/1/room/' . $room->id . '/edit')
                ->assertTitle('Admin | UPDATE ROOM')
                ->assertSee('Update room')
                ->type('name', 'A')
                ->type('descript', 'This is descript')
                ->type('price', '1000')
                ->type('total', '7')
                ->type('max_guest', '6')
                ->press('#old-img-' . $firstOldImage->id . ' button')
                ->assertSee('Are you sure you want to delete?')
                ->click('#delete-btn')
                ->assertPathIs('/admin/hotel/1/room/' . $room->id . '/edit')
                ->attach('images[]', $image)
                ->press('Submit')
                ->assertPathIs('/admin/hotel/1/room')
                ->assertSee('Update successful!');
            $roomAfterUpdate = Room::with('images')->find(4); 
            $quatityImage = count($roomAfterUpdate->images);
            if ($image !== '') {
                $this->assertTrue($quatityImage == 3);
                $this->assertDatabaseHas('images', ['path' => $roomAfterUpdate->images->last()->path]);
            } else {
                $this->assertTrue($quatityImage == 2);
            }
            $this->assertSoftDeleted('images', ['id' => $firstOldImage->id]);
            $this->assertDatabaseHas('rooms', ['name' => 'A']);
        });        
    }

    /**
     * List case for test validation update room
     *
     */
    public function listCaseTestValidationForUpdateRoom()
    {   
        return [
            ['', 'This is descript', '1000', '7' ,'6', $this->fakeFile(true), 'The name field is required.'],
            ['A', '', '1000', '7' ,'6', $this->fakeFile(true), 'The descript field is required.'],
            ['A', 'This is descript', '', '7' ,'6', $this->fakeFile(true), 'The price field is required.'],
            ['A', 'This is descript', '1000', '' ,'6', $this->fakeFile(true), 'The total field is required.'],
            ['A', 'This is descript', '1000', '7' ,'', $this->fakeFile(true), 'The max guest field is required.'],
            ['A', 'This is descript', '1000', '7' ,'6', $this->fakeFile(false), 'The images.0 must be an image.'],
        ];
    }

    /**
     * @dataProvider listCaseTestValidationForUpdateRoom
     *
     */
    public function testUpdateRoomFailValidation(
        $name,
        $descript,
        $price,
        $total,
        $maxGuest,
        $image,
        $expected
    ) {   
        
        $this->browse(function (Browser $browser) use(
            $name,
            $descript,
            $price,
            $total,
            $maxGuest,
            $image,
            $expected
        ) {
            $this->makeRoomOfHotel(1, 5);
            $room = Room::with('images')->find(4);
            $browser->visit('/admin/hotel/1/room/' . $room->id . '/edit')
                    ->assertTitle('Admin | UPDATE ROOM')
                    ->assertSee('Update room')
                    ->type('name', $name)
                    ->type('descript', $descript)
                    ->type('price', $price)
                    ->type('total', $total)
                    ->type('max_guest', $maxGuest)
                    ->attach('images[]', $image)
                    ->press('Submit')
                    ->assertSee($expected)
                    ->assertPathIs('/admin/hotel/1/room/' . $room->id . '/edit');
        });
    }

    /**
     * Test 404 Page Not found when click edit room but not found hotel of room.
     *
     * @return void
     */
    public function test404PageForClickEditNotFoundHotelOfRoom()
    {   
        $this->makeRoomOfHotel(1, 5);
        $this->browse(function (Browser $browser) {
            $hotel = Hotel::find(1);
            $room = Room::with('images')->find(4);
            $browser->visit('/admin/hotel/1/room')
                    ->assertTitle('Admin | Room')
                    ->assertSee('List Rooms');
            $hotel->delete();
            $browser->press('#table-contain tbody tr:nth-child(2) td:nth-child(7) a');
            $browser->assertSee('404 - Page Not found');
        });
    }

    /**
     * Test 404 Page Not found when click edit room but not found room.
     *
     * @return void
     */
    public function test404PageForClickEditNotFoundRoom()
    {   
        $this->makeRoomOfHotel(1, 5);
        $this->browse(function (Browser $browser) {
            $room = Room::with('images')->find(4);
            $browser->visit('/admin/hotel/1/room')
                    ->assertTitle('Admin | Room')
                    ->assertSee('List Rooms');
            $room->delete();
            $browser->press('#table-contain tbody tr:nth-child(2) td:nth-child(7) a');
            $browser->assertSee('404 - Page Not found');
        });
    }

    /**
     * Test 404 Page Not found when click submit edit room but not found hotel of room.
     *
     * @return void
     */
    public function test404PageForClickSubmitNotFoundHotelOfRoom()
    {   
        $this->makeRoomOfHotel(1, 5);
        $this->browse(function (Browser $browser) {
            $hotel = Hotel::find(1);
            $room = Room::with('images')->find(4);
            $browser->visit('/admin/hotel/1/room')
                    ->assertTitle('Admin | Room')
                    ->assertSee('List Rooms')
                    ->press('#table-contain tbody tr:nth-child(2) td:nth-child(7) a')
                    ->assertPathIs('/admin/hotel/1/room/' . $room->id . '/edit')
                    ->assertTitle('Admin | UPDATE ROOM')
                    ->assertSee('Update room')
                    ->type('name', 'A')
                    ->type('descript', 'This is descript')
                    ->type('price', '1000')
                    ->type('total', '7')
                    ->type('max_guest', '6');
            $hotel->delete();
            $browser->press('Submit')->assertSee('404 - Page Not found');
                    
        });
    }

     /**
     * Test 404 Page Not found when click submit edit room but not found room.
     *
     * @return void
     */
    public function test404PageForClickSubmitNotFoundRoom()
    {   
        $this->makeRoomOfHotel(1, 5);
        $this->browse(function (Browser $browser) {
            $room = Room::with('images')->find(4);
            $browser->visit('/admin/hotel/1/room')
                    ->assertTitle('Admin | Room')
                    ->assertSee('List Rooms')
                    ->press('#table-contain tbody tr:nth-child(2) td:nth-child(7) a')
                    ->assertPathIs('/admin/hotel/1/room/' . $room->id . '/edit')
                    ->assertTitle('Admin | UPDATE ROOM')
                    ->assertSee('Update room')
                    ->type('name', 'A')
                    ->type('descript', 'This is descript')
                    ->type('price', '1000')
                    ->type('total', '7')
                    ->type('max_guest', '6');
            $room->delete();
            $browser->press('Submit')->assertSee('404 - Page Not found');
                    
        });
    }


    /**
     * Fake file 
     * 
     * @param boolean $isImage check file is image
     * 
     * @return string
     */
    public function fakeFile($isImage)
    { 
        $file = $isImage ? UploadedFile::fake()->image('image.jpg') : UploadedFile::fake()->create('file.pdf');
        return $file;
    }
}
