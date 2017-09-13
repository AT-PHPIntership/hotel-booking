<?php

namespace Tests\Browser\Pages\Backend\Rooms;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\Room;
use App\Model\Place;
use App\Model\Hotel;
use Illuminate\Http\UploadedFile;
use Faker\Factory as Faker;

class AdminCreateRoomTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test Route View Admin Create Room.
     *
     * @return void
     */
    public function testCreatesRoom()
    {
        $this->makeHotel(1);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/hotel/1/room')
                    ->click('#btn-add-room')
                    ->assertPathIs('/admin/hotel/1/room/create')
                    ->assertSee('Create room');
        });
    }

    /**
     * Test Validation Admin Create Room.
     *
     * @return void
     */
    public function testValidationCreatesRoom()
    {
        $this->makeHotel(1);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/hotel/1/room/create')
                    ->press('Submit')
                    ->assertPathIs('/admin/hotel/1/room/create')
                    ->assertSee('The descript field is required.')
                    ->assertSee('The price field is required.')
                    ->assertSee('The total field is required.')
                    ->assertSee('The max guest field is required.')
                    ->assertSee('The images field is required.');
        });
    }

    /**
     * Test Admin create Room success.
     *
     * @return void
     */
    public function testCreatesRoomSuccess()
    {
        $this->makeHotel(1);
        $this->browse(function (Browser $browser) {
            $image = $this->fakeFile(true);
            $browser->visit('/admin/hotel/1/room/create')
                    ->assertTitle('Admin | Add room')
                    ->assertSee('Create room')
                    ->type('name','A')
                    ->type('descript','This is descript')
                    ->type('price','1000')
                    ->type('total','7')
                    ->type('max_guest','6')
                    ->attach('images[]', $image)
                    ->press('Submit')
                    ->assertPathIs('/admin/hotel/1/room')
                    ->assertSee('Creation successful!')
                    ->assertSeeIn('#table-contain tbody tr:nth-child(1) td:nth-child(3)', 'A');
        });
        $this->assertDatabaseHas('rooms', ['name' => 'A']);
    }

    public function listCaseTestValidationForCreateRoom()
    {
        return [
            ['', 'This is descript', '1000', '7' ,'6', $this->fakeFile(true), 'The name field is required.'],
            ['A', '', '1000', '7' ,'6', $this->fakeFile(true), 'The descript field is required.'],
            ['A', 'This is descript', '', '7' ,'6', $this->fakeFile(true), 'The price field is required.'],
            ['A', 'This is descript', '1000', '' ,'6', $this->fakeFile(true), 'The total field is required.'],
            ['A', 'This is descript', '1000', '7' ,'', $this->fakeFile(true), 'The max guest field is required.'],
            ['A', 'This is descript', '1000', '7' ,'6', '', 'The images field is required.'],
            ['A', 'This is descript', '1000', '7' ,'6', $this->fakeFile(false), 'The images.0 must be an image.'],
        ];
    }

    /**
     * @dataProvider listCaseTestValidationForCreateRoom
     *
     */
    public function testCreateRoomFailValidation(
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
            $this->makeHotel(1);
            $browser->visit('/admin/hotel/1/room/create')
                    ->assertTitle('Admin | Add room')
                    ->assertSee('Create room')
                    ->type('name', $name)
                    ->type('descript', $descript)
                    ->type('price', $price)
                    ->type('total', $total)
                    ->type('max_guest', $maxGuest)
                    ->attach('images[]', $image)
                    ->press('Submit')
                    ->assertSee($expected)
                    ->assertPathIs('/admin/hotel/1/room/create');
        });
    }

    /**
     * Test Button Reset
     *
     * @return void
     */
    public function testBtnReset()
    {
        $this->makeHotel(1);
        $this->browse(function (Browser $browser) {
            $image = $this->fakeFile(true);
            $browser->visit('/admin/hotel/1/room/create')
                    ->assertTitle('Admin | Add room')
                    ->assertSee('Create room')
                    ->type('name','A')
                    ->type('descript','This is descript')
                    ->type('price','1000')
                    ->type('total','7')
                    ->type('max_guest','6')
                    ->attach('images[]', $image)
                    ->press('Reset')
                    ->assertPathIs('/admin/hotel/1/room/create')
                    ->assertTitle('Admin | Add room')
                    ->assertInputValue('name', '')
                    ->assertInputValue('descript', '')
                    ->assertInputValue('price', '')
                    ->assertInputValue('total', '')
                    ->assertInputValue('max_guest', '')
                    ->assertInputValue('images[]', '');
        });
    }
    
    /**
     * Fake image 
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

    /**
     * Make hotel which has id = $idHotel
     */
    public function makeHotel($idHotel)
    {
        factory(Place::class, 5)->create();
        $placeIds = Place::all('id')->pluck('id')->toArray();
        $faker = Faker::create();
        for ($i = 0; $i < $idHotel; $i++) {
            factory(Hotel::class, 1)->create([
                'place_id' => $faker->randomElement($placeIds)
            ]);
        }
    }
}
