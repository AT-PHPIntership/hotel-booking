<?php

namespace Tests\Browser\Pages\Backend\Places;

use Tests\DuskTestCase;
use App\Model\Place;
use App\Model\Hotel;
use Laravel\Dusk\Browser;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminShowDetailPlaceTest extends DuskTestCase
{   
    use DatabaseMigrations;

    /**
     * Make place data to testing
     */
    public function setUp()
    {
        parent::setUp();
        Place::create([
            'name' => 'Da Nang',
            'descript' => 'City of Viet Nam',
            'image' => 'image.jpg',
         ]);
        $faker = Faker::create();
        for ($i = 0; $i < 5; $i++) {
            $hotel = factory(Hotel::class, 1)->create([
                'place_id'=> '1'
            ]);
        }
    }

    /**
     * Visit link place at place name
     * @param Browser $browser instance of browser
     * @param int $place place object  
     * @return Object
     */
    public function visitUrlPlaceShow($browser, $place)
    {
        $page = $browser->visit('/admin/place')
            ->click('#table-contain tbody tr:nth-child(1) td:nth-child(3) a');
        $page->assertPathIs('/admin/place/' . $place->id)
            ->assertSee('Place detail');
        return $page;
    }

    /**
     * Test admin show detail place.
     *
     * @return void
     */
    public function testShowDetailPlace()
    {
        $place = Place::find(1);
        $this->browse(function (Browser $browser) use ($place) {
            $page = $this->visitUrlPlaceShow($browser, $place);

            $name = $page->text("#place-detail-name");
            $descript = $page->text("#place-detail-descript");
            $this->assertTrue($name === $place->name);
            $this->assertTrue($descript === $place->descript);

            $element = $page->element('.cls-image-place-detail');
            $imageSrc = $element->getAttribute('src');
            $imageName = explode('/', $imageSrc);
            $this->assertTrue($imageName[5] === $place->image);

            $totalHotels = $place->hotels()->count();
            $page->assertSee($totalHotels .  " hotel in " . $place->name);
        });
    }

    /**
     * Test 404 Page Not found when click url at place name .
     *
     * @return void
     */
    public function test404PageNotFound()
    {   
        $place = Place::find(1);
        $this->browse(function (Browser $browser) use ($place) {
            $browser->visit('/admin/place')->assertSee('List place')
                ->assertSee($place->name);
            $place->delete();
            $browser->click('#table-contain tbody tr:nth-child(1) td:nth-child(3) a');
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
        $place = Place::find(1);
        $this->browse(function (Browser $browser) use ($place) {
            $this->visitUrlPlaceShow($browser, $place) 
                ->click('#btn-go-back')
                ->assertPathIs('/admin/place');
        });
    }

     /**
     * Test Button Edit
     *
     * @return void
     */
    public function testBtnEdit()
    {   
        $place = Place::find(1);
        $this->browse(function (Browser $browser) use ($place) {
            $this->visitUrlPlaceShow($browser, $place) 
                ->click('#btn-edit')
                ->assertPathIs('/admin/place/' . $place->id . '/edit');
        });
    }
}
