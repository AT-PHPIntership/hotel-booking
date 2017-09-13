<?php

namespace Tests\Browser\Pages\Backend\Homepage;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Model\Category;
use App\Model\News;
use App\Model\Reservation;
use App\Model\User;
use App\Model\Hotel;
use App\Model\Place;
use App\Model\Guest;
use App\Model\Room;
use Faker\Factory as Faker;

class AdminHomePageTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test route.
     *
     * @return void
     */
    public function testRoute()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin')
                ->clickLink('Home Page')
                ->assertPathIs('/admin')
                ->assertSee('Home Page');
        });
    }
 
    /**
     * A Dusk test empty data.
     *
     * @return void
     */
    public function testEmptyData()
    {
        $this->browse(function (Browser $browser){
            $browser->visit('/admin')
                ->clickLink('Home Page')
                ->assertSee('Categories')
                ->assertSee('Places')
                ->assertSee('News')
                ->assertSee('Booking Rooms')
                ->assertSee('Hotels')
                ->assertSee('Users')
                ->assertSeeIn('.small-box .inner h3', '0');
        });
    }
     
    /**
     * A Dusk test value.
     *
     * @return void
     */
    public function testValueOnPage()
    {
        $this->makeData(10);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin')
                ->clickLink('Home Page')
                ->assertSee('Categories')
                ->assertSee('Places')
                ->assertSee('News')
                ->assertSee('Booking Rooms')
                ->assertSee('Hotels')
                ->assertSee('Users')
                ->assertSeeIn('.small-box .inner h3', '10');
        });
    }

    /**
     * Case test fot test connect page
     *
     * @return array
     */
    public function caseTestConnectPage()
    {
        return [
            [1, 'news',  'News'],
            [2, 'place', 'places'],
            [3, 'user', 'Users'],
            [4, 'category', 'Categories'],
            [5, 'hotel', 'of hotels'],
            [6, 'reservation', 'Booking Rooms']
        ];
    }

    /**
    * A Dusk test test connected Page.
    *
    * @dataProvider caseTestConnectPage
    *
    * @return void
    */
    public function testConnectPage($number, $link, $str) 
    {
        $this->makeData(10);
        $this->browse(function (Browser $browser) use ($number, $link, $str) {
            $browser->visit('/admin')
                ->clickLink('Home Page')
                ->press('.row .col-lg-3:nth-child('.$number.') .small-box a')
                ->assertPathIs('/admin/'.$link)
                ->assertSee('List '.$str);
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
        factory(Category::class, $row)->create();
        factory(Guest::class, $row)->create();
        $placeIds = Place::all('id')->pluck('id')->toArray();
        $faker = Faker::create();
        for ($i = 0; $i < $row; $i++) {
            factory(Hotel::class, 1)->create([
                'place_id' => $faker->randomElement($placeIds)
            ]);
        }
        $hotelIds = Hotel::all('id')->pluck('id')->toArray();
        for ($i = 0; $i < $row; $i++) {
            factory(Room::class, 1)->create([
                'hotel_id' => $faker->randomElement($hotelIds),
            ]);
        }
        $roomIds = Room::all('id')->pluck('id')->toArray();
        for ($i = 0; $i < $row; $i++) {
            factory(Reservation::class, 1)->create([
                'room_id' => $faker->randomElement($roomIds),
            ]);
        }
        $categoryIds = Category::all('id')->pluck('id')->toArray();
        for ($i = 0; $i < $row; $i++) {
            factory(News::class, 1)->create([
                'category_id' => $faker->randomElement($categoryIds),
            ]);
        }
    }
}
