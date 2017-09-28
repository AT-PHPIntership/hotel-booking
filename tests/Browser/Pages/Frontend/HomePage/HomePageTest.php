<?php

namespace Tests\Browser\Pages\Frontend\HomePage;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\Room;
use App\Model\Hotel;
use App\Model\Place;
use App\Model\User;
use App\Model\Guest;
use App\Model\Reservation;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Cache;

class HomePageTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test route Homepage.
     *
     * @return void
     */
    public function testRouteHomePage()
    {
        $this->browse(function (Browser $browser) {
            Cache::flush();
            $browser->visit('/')
                    ->assertTitle('Home page')
                    ->assertVisible('#reservation-form')
                    ->assertSee('Outstanding Places')
                    ->assertSee('Representative Hotels')
                    ->assertSee('Why should you choose us?')
                    ->assertPathIs('/');
        });
    }

    /**
     * Test show top places if not data or data of places < 7.
     *
     * @return void
     */
    public function testShowTopPlaceIfNotData()
    {
        $this->browse(function (Browser $browser) {
            Cache::flush();
            $browser->visit('/')
                    ->assertTitle('Home page')
                    ->assertSee('Outstanding Places')
                    ->assertSee('Sorry! The system is updating')
                    ->assertMissing('#top-3-places .container .row .col-sm-4')
                    ->assertMissing('#top-4-places .container .row .col-sm-3')
                    ->assertPathIs('/');
        }); 
    }

    /**
     * Test show top hotel if not has data or data of hotel < 6.
     *
     * @return void
     */
    public function testShowTopHotelIfNotData()
    {   
        $this->browse(function (Browser $browser) {
            Cache::flush();
            $browser->visit('/')
                    ->assertTitle('Home page')
                    ->assertSee('Representative Hotels')
                    ->assertSee('Sorry! The system is updating')
                    ->assertMissing('#top-hotels .container .row .col-sm-4 .room-thumb')
                    ->assertPathIs('/');
        }); 
    }
    /**
     * Test show top place if has data.
     *
     * @return void
     */
    public function testShowTopPlaceIfHasData()
    {   
        $this->makeData(7);
        $this->browse(function (Browser $browser) {
            Cache::flush();
            $browser->visit('/')
                    ->assertTitle('Home page')
                    ->assertSee('Outstanding Places')
                    ->assertPathIs('/');
            $count = count($browser->elements('#top-3-places .container .row .col-sm-4')) + count($browser->elements('#top-4-places .container .row .col-sm-3'));
            $this->assertTrue($count == 7);
        }); 
    }

   


    /**
     * Test show top hotel if has data.
     *
     * @return void
     */
    public function testShowTopHotelIfHasData()
    {   
        $this->makeData(7);
        $this->browse(function (Browser $browser) {
            Cache::flush();
            $browser->visit('/')
                    ->assertTitle('Home page')
                    ->assertSee('Representative Hotels')
                    ->assertPathIs('/');
            $count = count($browser->elements('#top-hotels .container .row .col-sm-4'));
            $this->assertTrue($count == 6);
        }); 
    }

    /**
     * Test link Home.
     *
     * @return void
     */
    public function testLinkHome()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/profile/1')
                    ->assertTitle('User Profile')
                    ->assertSee('User Profile')
                    ->clickLink('Home')
                    ->assertTitle('Home page')
                    ->assertSee('Representative Hotels')
                    ->assertPathIs('/');
            $browser->visit('/profile/1')
                    ->assertTitle('User Profile')
                    ->assertSee('User Profile')
                    ->click('.logo-header')
                    ->assertTitle('Home page')
                    ->assertSee('Representative Hotels')
                    ->assertPathIs('/');
        }); 
    }

    /**
     * Test link list hotels.
     *
     * @return void
     */
    public function testLinkHotels()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertTitle('Home page')
                    ->assertSee('Representative Hotels')
                    ->clickLink('Hotels')
                    ->assertTitle('LIST HOTELS')
                    ->assertSee('List Hotels')
                    ->assertPathIs('/hotels');
        }); 
    }

    /**
     * Test link list News.
     *
     * @return void
     */
    public function testLinkNews()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertTitle('Home page')
                    ->assertSee('Representative Hotels')
                    ->clickLink('News')
                    ->assertTitle('News')
                    ->assertSee('TOP NEWS')
                    ->assertPathIs('/news');
        }); 
    }

    /**
     * Test link login.
     *
     * @return void
     */
    public function testLinkLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->logout();
            $browser->visit('/')
                    ->assertTitle('Home page')
                    ->assertSee('Representative Hotels')
                    ->clickLink('Login')
                    ->assertTitle('Login')
                    ->assertSee('Login')
                    ->assertPathIs('/login');
        }); 
    }

    /**
     * Test link register.
     *
     * @return void
     */
    public function testLinkRegister()
    {
        $this->browse(function (Browser $browser) {
            $browser->logout();
            $browser->visit('/')
                    ->assertTitle('Home page')
                    ->assertSee('Representative Hotels')
                    ->clickLink('Register')
                    ->assertTitle('Register')
                    ->assertSee('Register')
                    ->assertPathIs('/register');
        }); 
    }

    /**
     * Test link feedback
     *
     * @return void 
     */
    public function testLinkFeedback()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertTitle('Home page')
                    ->assertSee('Representative Hotels')
                    ->clickLink('Feedback')
                    ->assertTitle('Feedback')
                    ->assertSee('Feedback')
                    ->assertPathIs('/sendfeedback/create');
        });
    }

    /**
     * Make data for test.
     *
     * @return void
     */
    public function makeData($row)
    {   
        factory(Place::class, $row)->create();
        factory(User::class, $row)->create();
        factory(Guest::class, $row)->create();
        $placeIds = Place::all('id')->pluck('id')->toArray();
        $faker = Faker::create();
        foreach ($placeIds as $placeId) {
            factory(Hotel::class, 1)->create([
                'place_id' => $placeId
            ]);
        }
        $hotelIds = Hotel::all('id')->pluck('id')->toArray();
        foreach ($hotelIds as $hotelId) {
            factory(Room::class, 1)->create([
                'hotel_id' => $hotelId
            ]);
        }
        $roomIds = Room::all('id')->pluck('id')->toArray();
        foreach ($roomIds as $roomId) {
            factory(Reservation::class, 1)->create([
                'room_id' => $roomId
            ]); 
        }      
    }     
}
