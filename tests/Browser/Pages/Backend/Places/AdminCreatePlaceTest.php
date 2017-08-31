<?php

namespace Tests\Browser\Pages\Backend;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;

class AdminCreatePlaceTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test URL admin create place.
     *
     * @return void
     */
    public function testURLCreatesPlace()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/place')
                ->clickLink('Add Place')
                ->assertPathIs('/admin/place/create')
                ->assertSee('Add place');
        });
    }

    /**
     * Test validation admin create place.
     *
     * @return void
     */
    public function testValidation()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/place/create')
                ->press('Submit')
                ->assertPathIs('/admin/place/create')
                ->assertSee('The name field is required.')
                ->assertSee('The descript field is required.')
                ->assertSee('The image field is required.');
        });
    }

    /**
     * Test Admin create place success.
     *
     * @return void
     */
    public function testCreateSuccess()
    {   
        $this->browse(function (Browser $browser) {
            $image = $this->fakeImage();
            $page = $browser->visit('/admin/place/create')
                ->type('name','Ha Noi');
            $this->typeInCKEditor($browser, '#cke_descript iframe', 'City of Viet Nam');
            $page->attach('image', $image) 
                ->press('Submit')
                ->assertPathIs('/admin/place')
                ->assertSee('Create success');
        });
        $this->assertDatabaseHas('places', ['name' => 'Ha Noi']); 
    }
    
    /**
     * List case for test validation create place
     *
     */
    public function listCaseTestForCreatePlace()
    {   
        $image = $this->fakeImage();
        return [
            ['', 'City of Viet Nam', $image, 'The name field is required.'],
            ['Ha Noi', '', $image, 'The descript field is required.'],
            ['Ha Noi', 'City of Viet Nam', '', 'The image field is required.']
        ];
    }

    /**
     * Test create place fail
     *
     * @dataProvider listCaseTestForCreatePlace
     * 
     * @param string $name place name
     * @param string $descript place descript
     * @param string $image place image
     * @param string $expected message warning
     * 
     */
     public function testCreatePlaceFail($name, $descript, $image, $expected)
    {   
        
        $this->browse(function (Browser $browser) use ($name, $descript, $image, $expected) {
            $page = $browser->visit('/admin/place/create')
                ->type('name', $name);
            $this->typeInCKEditor($browser, '#cke_descript iframe', $descript);
            $page->attach('image',  $image )
                ->press('Submit')
                ->assertSee($expected)
                ->assertPathIs('/admin/place/create');
        });
    }

    /**
     * Test Button Reset
     *
     * @return void
     */
    public function testBtnReset()
    {
        $this->browse(function (Browser $browser) {
            $image = $this->fakeImage();
            $page = $browser->visit('/admin/place/create')
                ->type('name', 'Ha Noi');
            $this->typeInCKEditor($browser, '#cke_descript iframe', 'Viet Nam');
            $page->attach('image', $image)
                ->press('Reset')
                ->assertPathIs('/admin/place/create')
                ->assertInputValue('name', '')
                ->assertInputValue('descript', '')
                ->assertInputValue('image', '');
        });
    }

    /**
     * Test Button Back
     *
     * @return void
     */
    public function testBtnBack()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/place')
                ->clickLink('Add Place')
                ->click('.box-footer .btn-default')
                ->assertPathIs('/admin/place');
        });
    }
    
    /**
     * Fake image place
     * 
     * @return string
     */
    public function fakeImage()
    {    
        $image = UploadedFile::fake()->image('image.jpg');
        return $image;
    }
}
