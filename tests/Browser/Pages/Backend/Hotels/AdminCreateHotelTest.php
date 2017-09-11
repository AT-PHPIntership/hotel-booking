<?php

namespace Tests\Browser\Pages\Backend\Hotels;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\Place;
use App\Model\Hotel;
use App\Model\Service;
use Faker\Factory as Faker;
use Illuminate\Http\UploadedFile;

class AdminCreateHotelTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test ULR create hotel
     *
     * @return void
     */
    public function testURLCreateHotel()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/hotel')
                ->clickLink('Add hotel')
                ->assertPathIs('/admin/hotel/create')
                ->assertSee('Create hotel');
        });
    }

    /**
     * Test Validation Create Hotel.
     *
     * @return void
     */
    public function testValidation()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/hotel/create')
                    ->press('Submit')
                    ->assertPathIs('/admin/hotel/create')
                    ->assertSee('The name field is required.')
                    ->assertSee('The address field is required.')
                    ->assertSee('The place id field is required.')
                    ->assertSee('The star field is required.')
                    ->assertSee('The introduce field is required.')
                    ->assertSee('The images field is required.');
        });
    }

    /**
     * Test create success.
     *
     * @return void
     */
    public function testCreateSuccess()
    {
        factory(Place::class, 5)->create();
        factory(Service::class, 5)->create();
        $this->browse(function (Browser $browser) {
            $image = $this->fakeFile();
            $browser->visit('/admin/hotel/create')
                    ->assertSee('Create hotel')
                    ->type('name','Dophin Hotel')
                    ->type('address','142 HaHuyTap')
                    ->select('place_id', 2)
                    ->select('star', 5)
                    ->type('introduce','This is Dophin hotel')
                    ->attach('images[]', $image)
                    ->check('services[]')
                    ->press('Submit')
                    ->assertPathIs('/admin/hotel')
                    ->assertSee('Create success')
                    ->assertSeeIn('#table-contain tbody tr:nth-child(1) td:nth-child(2)', 'Dophin Hotel')
                    ->assertSeeIn('#table-contain tbody tr:nth-child(1) td:nth-child(3)', '142 HaHuyTap');
        });
        $this->assertDatabaseHas('hotels', ['name' => 'Dophin Hotel']);
    }

    public function listCaseTestValidation()
    {
        return [
            ['', 'This is Address', '2', '4' ,'This is introduce', $this->fakeFile(), 'The name field is required.'],
            ['Dophin', '', '2', '4' ,'This is introduce', $this->fakeFile(), 'The address field is required.'],
            ['Dophin', 'This is Address', '', '4' ,'This is introduce', $this->fakeFile(), 'The place id field is required.'],
            ['Dophin', 'This is Address', '2', '' ,'This is introduce', $this->fakeFile(), 'The star field is required.'],
            ['Dophin', 'This is Address', '2', '4' ,'', $this->fakeFile(), 'The introduce field is required.'],
            ['Dophin', 'This is Address', '2', '4' ,'This is introduce', '', 'The images field is required.'],
        ];
    }

    /**
     * @dataProvider listCaseTestValidation
     *
     */
    public function testCreateFailValidation(
        $name,
        $address,
        $placeId,
        $star,
        $introduce,
        $image,
        $expected
    ) {   

        $this->browse(function (Browser $browser) use (
            $name,
            $address,
            $placeId,
            $star,
            $introduce,
            $image,
            $expected
        ) {
            factory(Place::class, 5)->create();
            factory(Service::class, 5)->create();
            $browser->visit('/admin/hotel/create')
                    ->assertSee('Create hotel')
                    ->type('name',$name)
                    ->type('address', $address)
                    ->select('place_id', $placeId)
                    ->select('star', $star)
                    ->type('introduce', $introduce)
                    ->attach('images[]', $image)
                    ->press('Submit')
                    ->assertPathIs('/admin/hotel/create')
                    ->assertSee($expected);
        });
    }

    /**
     * Test Click button Reset in Create hotel page
     *
     * @return void
     */
    public function testClickReset()
    {
        factory(Place::class, 5)->create();
        factory(Service::class, 5)->create();
        $this->browse(function (Browser $browser) {
            $image = $this->fakeFile();
            $browser->visit('/admin/hotel/create')
                    ->assertSee('Create hotel')
                    ->type('name','Dophin Hotel')
                    ->type('address','142 HaHuyTap')
                    ->select('place_id', 2)
                    ->select('star', 5)
                    ->type('introduce','This is Dophin hotel')
                    ->attach('images[]', $image)
                    ->check('services[]')
                    ->press('Reset')
                    ->assertPathIs('/admin/hotel/create')
                    ->assertInputValue('name', '')
                    ->assertInputValue('address', '')
                    ->assertInputValue('introduce', '')
                    ->assertInputValue('images[]', '')
                    ->assertNotChecked('services[]');
        });
    }

    /**
     * Fake image 
     * 
     * @return file
     */
    public function fakeFile()
    { 
        $file = UploadedFile::fake()->image('image.jpg');
        return $file;
    }
}
