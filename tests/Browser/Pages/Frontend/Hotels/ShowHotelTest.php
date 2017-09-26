<?php

namespace Tests\Browser\Pages\Frontend\Hotels;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\Hotel;
use App\Model\User;
use App\Model\Place;
use App\Model\Room;
use App\Model\Service;
use App\Model\Reservation;
use App\Model\HotelService;
use App\Model\RatingComment;
use Carbon\Carbon;
use Faker\Factory as Faker;

class ShowHotelTest extends DuskTestCase
{
    use DatabaseMigrations;
    
    /**
     * Test 404 Page Not found when show hotel not exists.
     *
     * @return void
     */
    public function test404Page()
    {   
        $this->makeHotelAndService(5);
        $hotel = Hotel::find(1);
        $slug = $hotel->slug;
        $this->browse(function (Browser $browser) use ($hotel, $slug) {
            $selector = 'main section:nth-child(2) .container .row div:nth-child(2) .room-thumb .mask .content';
            $page = $browser->visit('/hotels')
                ->assertSee('List Hotels')
                ->assertSee($hotel->name)
                ->assertPathIs('/hotels');
            $hotel->delete();        
            $page->mouseover($selector)
                ->whenAvailable($selector, function ($selectorAvailable) {
                    $selectorAvailable->click('.btn');
                });
            $page->assertSee('404 - Page Not found')
                ->assertPathIs('/hotels/' . $slug);;
        });
    }

    /**
     * Click hotel from list hotels
     *
     * @param Browser $browser instance of Browser
     * @param Hotel  $hotel    hotel object   
     *
     * @return page
     */
    public function clickHotelFromList($browser, $hotel)
    {
        $selector = 'main section:nth-child(2) .container .row div:nth-child(2) .room-thumb .mask .content';
        $page = $browser->visit('/hotels')
            ->assertSee('List Hotels')
            ->assertSee($hotel->name)
            ->mouseover($selector)
            ->whenAvailable($selector, function ($selectorAvailable) {
                $selectorAvailable->click('.btn');
            });
        $page->assertSee($hotel->name);

        return $page;
    }

    /**
     * Test all data on hotel page 
     *
     * @return void
     */
    public function testDataHotelOnPage()
    {   
        $this->makeHotelAndService(5);
        $this->makeRatingComment(4);
        $hotel = Hotel::find(1);
        $checkoutDateDefault = Carbon::tomorrow()->addWeeks(Hotel::WEEK_NUMBER);
        $checkinDateDefault = $checkoutDateDefault->toDateTimeString();
        $checkoutDateDefault->addDay()->toDateTimeString();

        $this->browse(function (Browser $browser) use ($hotel, $checkinDateDefault, $checkoutDateDefault) {
            $page = $this->clickHotelFromList($browser, $hotel); 
         
            $placeName = $page->text('.breadcrumb li:nth-child(2) a');
            $this->assertTrue($hotel->place->name === $placeName); 

            $address = $page->text('.cls-box-info-hotel p:nth-of-type(2) span') ;
            $this->assertTrue('Address: ' . $hotel->address == $address);

            $star = $page->elements('.cls-star-hotel');
            $this->assertCount($hotel->star, $star );

            $ratingElm = $page->text('.cls-rating-hotel');

            $rating =  $hotel->round_avg_rating . '/10 ' . $hotel->label_rating;
            $this->assertTrue($ratingElm == $rating);

            $serviceElm = $page->elements('.cls-list-service ul li');
            $countService = $services = $hotel->services()->count();
            $this->assertCount($countService, $serviceElm);

            $introduce = $page->text('.cls-body-introduce-hotel');
            $this->assertTrue($introduce == $hotel->introduce);

            $checkinCheckoutTimeElm = $page->text('.cls-checkin-checkout-date');
            $checkinCheckout = 'List vacancies from ' . formatDateTimeToDate($checkinDateDefault) .' to ' . formatDateTimeToDate($checkoutDateDefault) . ' .' ;
            $this->assertTrue($checkinCheckoutTimeElm == $checkinCheckout);

        }); 
    }

    /**
     * Test list room empty data
     *
     * @return void
     */
    public function testListRoomEmpty()
    {
        $this->makeHotelAndService(5);
        $hotel = Hotel::find(1);
        $this->browse(function (Browser $browser) use ($hotel){
            $page = $this->clickHotelFromList($browser, $hotel)
                ->assertSee('Hotel not has room any ! Admin is updating !');
        });
    }

    /**
     * Test list room has data
     *
     * @return void
     */
    public function testListRoomHasData()
    {  
        $this->makeHotelAndService(5);
        $hotel = Hotel::find(1);
        $this->browse(function (Browser $browser) use ($hotel) {
            $this->makeRoom(3);
            $page = $this->clickHotelFromList($browser, $hotel);
            $roomElm = $page->elements('.list-room') ;
            $this->assertCount(3, $roomElm);
        });
    }

    /**
     * Test have room empty and not have room empty
     *
     * @return void
     */
    public function testHasAndNoVacancies()
    {
        $this->makeHotelAndService(5);
        $hotel = Hotel::find(1);
        $this->browse(function (Browser $browser) use ($hotel){
            $this->makeRoom(1);
            $this->makeReservation(1, 2);
            $page = $this->clickHotelFromList($browser, $hotel)
                ->assertSee('Only 2 room(s) left');
            $this->makeReservation(1, 2);
            $this->clickHotelFromList($browser, $hotel)
                ->assertSee('We have no vacancies left.') ;
        });
    }
    
    /**
     * Test not have rating comment in hotel
     *
     * @return void 
     */
    public function testNoRatingComment()
    {   
        $this->makeHotelAndService(5);
        $hotel = Hotel::find(1);
        $this->browse(function (Browser $browser) use ($hotel){
            $page = $this->clickHotelFromList($browser, $hotel)
                ->assertSee('No comments for this hotel.');
        });
    }

    /**
     * Test have rating comment in hotel
     *
     * @return void
     */
    public function testHasRatingComment()
    {
        $this->makeHotelAndService(5);
        $hotel = Hotel::find(1);
        $this->browse(function (Browser $browser) use ($hotel){
            $this->makeRatingComment(3);
            $page = $this->clickHotelFromList($browser, $hotel);
            $commentElm = $page->elements('.comment-old'); 
            $this->assertCount(3, $commentElm); 
        });
    }
    
    /**
     *  Make data place, hotel and service for test.
     *
     * @param int $row number row in table you want to make 
     *
     * @return void
     */
    public function makeHotelAndService($row)
    {   
        factory(Place::class,$row)->create();
        factory(Service::class, $row)->create();
        $placeIds = Place::all('id')->pluck('id')->toArray();
        $faker = Faker::create();

        for ($i = 0; $i < 1; $i++) {
            factory(Hotel::class, 1)->create([
                'place_id' => $faker->randomElement($placeIds),
                'address' => $faker->text,
                'introduce' => $faker->text
            ]);
        }

        $hotelIds = Hotel::all('id')->pluck('id')->toArray();
        $serviceIds = Service::all('id')->pluck('id')->toArray();
        for ($i = 0; $i < $row; $i++) {
            factory(HotelService::class, 1)->create([
                'hotel_id' => $faker->randomElement($hotelIds),
                'service_id' => $faker->randomElement($serviceIds)
            ]);
        }
    }

    /**
     * Make data room for test
     *
     * @param int $row number row in table you want to make
     *
     * @return void
     */
    public function makeRoom($row)
    {
        $hotelIds =  Hotel::all('id')->pluck('id')->toArray();
        $faker = Faker::create();
        for ($i = 0; $i < $row; $i++) {
            factory(Room::class, 1)->create([
                'hotel_id' => $faker->randomElement($hotelIds),
                'total' => '4'
            ]);
        }
    }

    /**
     * Make reservation for test 
     *
     * @param int $row      number row in table you want to make
     * @param int $quantity quantity of reservation 
     * 
     * @return void
     */
    public function makeReservation($row, $quantity)
    {   
        $checkoutDate = Carbon::now()->addWeeks(Hotel::WEEK_NUMBER);
        $checkinDate = $checkoutDate->toDateTimeString();
        $checkoutDate->addDay(3)->toDateTimeString();

        for ($i = 0; $i < $row; $i++) {
            factory(Reservation::class, 1)->create([
                'room_id' => '1',
                'checkin_date' => $checkinDate,
                'checkout_date' => $checkoutDate,
                'quantity' => $quantity,
                'status' => '1'
            ]);
        }
    }

    /**
     * Make data rating comment for test
     *
     * @param int $row number row in table you want to make
     *
     * @return void
     */
    public function makeRatingComment($row)
    {   
        factory(User::class, $row)->create();
        $hotelIds = Hotel::all('id')->pluck('id')->toArray();
        $userIds = User::all('id')->pluck('id')->toArray();
        $faker = Faker::create();
        for ($i = 0; $i < $row; $i++) {
            factory(RatingComment::class, 1)->create([
                'hotel_id' => '1',
                'user_id' => $faker->randomElement($userIds)
            ]);
        }
    }
}
