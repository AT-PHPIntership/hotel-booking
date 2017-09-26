<?php

namespace Tests\Browser\Pages\Frontend\Places;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\Place;
use App\Model\Hotel;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Cache;

class ShowPlaceTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test route page show place.
     *
     * @return void
     */
    public function testShowPlace()
    {   
        Cache::flush();
        $this->makePlace(7);
        $this->browse(function (Browser $browser) {
            $selector = '#top-3-places .container .row div:nth-child(2) .room-thumb .mask .content';
            $text = $browser->visit('/')->text('#top-3-places .container .row div:nth-child(2) .room-thumb .mask .main div:nth-child(1) a');
            $placeName = explode(' |', $text);
            $place = Place::where('name', $placeName[0])->first();
            $browser->resize(1920, 2000)
                    ->visit('/')
                    ->assertTitle('Home page')
                    ->assertSee('Outstanding Places')
                    ->mouseover($selector)
                    ->whenAvailable($selector, function ($selectorAvailable) {
                        $selectorAvailable->click('.btn');
                    })
                    ->assertSee($place->name)
                    ->assertPathIs('/places/'.$place->slug);
        });
    }

    /**
     * Test value of page show detail place and has hotel in place.
     *
     * @return void
     */
    public function testValuePageShowPlace()
    {   
        $this->makePlace(7);
        $place = Place::find(1);
        $this->makeHotelOfPlace($place->id);
        $this->browse(function (Browser $browser) use ($place) {
            $totalHotel = $place->hotels->count();
            $browser->resize(1920, 2000)
                    ->visit('/places/'.$place->slug)
                    ->assertSee($place->name)
                    ->assertSee('There are '.$totalHotel.' hotels in '.$place->name)
                    ->assertSee('List Hotels of '.$place->name);
        });
    }

    /**
     * Test value of page show detail place and hasn't hotel in place.
     *
     * @return void
     */
    public function testValuePageShowPlaceIfNotHotel()
    {   
        $this->makePlace(7);
        $place = Place::find(1);
        $this->browse(function (Browser $browser) use ($place) {
            $totalHotel = $place->hotels->count();
            $browser->resize(1920, 2000)
                    ->visit('/places/'.$place->slug)
                    ->assertSee($place->name)
                    ->assertSee('There are '.$totalHotel.' hotels in '.$place->name)
                    ->assertSee('Sorry! The system is updating')
                    ->assertPathIs('/places/'.$place->slug);
        });
    }

    /**
     * Test show detail hotel in page show place.
     *
     * @return void
     */
    public function testShowDetailHotelInPageShowPlace()
    {   
        $this->makePlace(7);
        $place = Place::find(1);
        $this->makeHotelOfPlace($place->id);
        $this->browse(function (Browser $browser) use ($place) {
            $selector = '.container .row div:nth-child(2) .room-thumb .mask .content';
            $hotel = Hotel::find(1);
            $browser->visit('/places/'.$place->slug)
                    ->assertSee($place->name)
                    ->mouseover($selector)
                    ->whenAvailable($selector, function ($selectorAvailable) {
                        $selectorAvailable->click('.btn');
                    })
                    ->assertPathIs('/hotels/'.$hotel->slug);
                    
        });
    }

    /**
     * Test Error 404.
     *
     * @return void
     */
    public function testError404()
    {   
        Cache::flush();
        $this->makePlace(7);
        $this->browse(function (Browser $browser) {
            $selector = '#top-3-places .container .row div:nth-child(2) .room-thumb .mask .content';
            $text = $browser->visit('/')->text('#top-3-places .container .row div:nth-child(2) .room-thumb .mask .main div:nth-child(1) a');
            $placeName = explode(' |', $text);
            $place = Place::where('name', $placeName[0])->first();
            $browser->resize(1920, 2000)
                    ->visit('/')
                    ->assertTitle('Home page')
                    ->assertSee('Outstanding Places');
            $place->delete();
            $browser->mouseover($selector)
                    ->whenAvailable($selector, function ($selectorAvailable) {
                        $selectorAvailable->click('.btn');
                    })
                    ->assertSee('404 - Page Not found')
                    ->assertPathIs('/places/'.$place->slug);
        });
    }

    /**
     * Make data of place for test 
     *
     */
    public function makePlace($row)
    {   
        factory(Place::class, $row)->create();
    }

    /**
     * Make hotels of place for test
     *
     * @param int $id id of place
     *
     * @return void
     */
    public function makeHotelOfPlace($id)
    {
        factory(Hotel::class, 6)->create([
            'place_id' => $id
        ]);
    }
}
