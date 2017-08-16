<?php
namespace Tests\Browser\Pages\Backend;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
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
     * Test Validation Admin Create News.
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
            $browser->visit('/admin/place/create')
                    ->type('name','Ha Noi')
                    ->type('descript','City of Viet Nam')
                    ->attach('image', __DIR__.'/images/hanoi.jpg')
                    ->press('Submit')
                    ->assertPathIs('/admin/place')
                    ->assertSee('Create success');
        });
        $this->assertDatabaseHas('places', ['name' => 'Ha Noi']); 
    }
    
    /**
     * List case for Test Validation Create News
     *
     */
    public function listCaseTestForCreatePlace()
    {
        return [
            ['', 'City of Viet Nam', '/images/hanoi.jpg', 'The name field is required.'],
            ['Ha Noi', '', '/images/hanoi.jpg', 'The descript field is required.'],
            ['Ha Noi', 'City of Viet Nam', '', 'The image field is required.'],
        ];
    }

    /**
     * Test create place fail
     *
     * @dataProvider listCaseTestForCreatePlace
     */
     public function testCreatePlaceFail($name, $descript, $image, $expected)
    {   
        
        $this->browse(function (Browser $browser) use($name, $descript, $image, $expected) {
            $browser->visit('/admin/place/create')
                ->type('name', $name)
                ->type('descript',$descript)
                ->attach('image',  $image ? __DIR__.$image : null)
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
            $browser->visit('/admin/place/create')
                ->type('name', 'Ha Noi')
                ->type('descript', 'Viet Nam')
                ->attach('image', __DIR__.'/images/hanoi.jpg')
                ->press('Reset')
                ->assertPathIs('/admin/place/create')
                ->assertInputValue('name', '')
                ->assertInputValue('descript', '')
                ->assertInputValue('image', '');
        });
    }
}
