<?php

namespace Tests\Browser\Pages\Frontend\Reservation;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\Room;
use App\Model\Reservation;
use App\Model\Hotel;
use App\Model\Place;
use App\Model\Guest;
use App\Model\User;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;

class UserBookingRoomTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test route page booking room if don't search.
     *
     * @return void
     */
    public function testBookingRoom()
    {
        Cache::flush();
        $this->makeData(10);
        $hotel = Hotel::find(10);
        $this->makeRoom($hotel->id);
        $this->browse(function (Browser $browser) use ($hotel) {
            $selector = 'main section:nth-child(2) .container .row div:nth-child(2) .room-thumb .mask .content';
            $room = Room::orderby('price', 'ASC')->first();
            $browser->visit('/')
                    ->clickLink('Hotels')
                    ->mouseover($selector)
                    ->whenAvailable($selector, function ($selectorAvailable) {
                        $selectorAvailable->click('.btn');
                    })
                    ->assertSee($hotel->name)
                    ->assertPathIs('/hotels/'.$hotel->slug)
                    ->click('.room-item-booking a')   
                    ->assertSee('Hotel booking')
                    ->assertPathIs('/room/'.$room->id.'/reservations/create');
        }); 
    }

    /**
     * Test value page booking if guest visit and no cache search.
     *
     * @return void
     */
    public function testValuePageBookingOfGuestAndNoCache()
    {
        Cache::flush();
        $this->makeData(10);
        $hotel = Hotel::find(10);
        $this->makeRoom($hotel->id);
        $this->browse(function (Browser $browser) use ($hotel) {
            $selector = 'main section:nth-child(2) .container .row div:nth-child(2) .room-thumb .mask .content';
            $room = Room::orderby('price', 'ASC')->first();
            $browser->logout()
                    ->visit('/')
                    ->clickLink('Hotels')
                    ->mouseover($selector)
                    ->whenAvailable($selector, function ($selectorAvailable) {
                        $selectorAvailable->click('.btn');
                    })
                    ->assertSee($hotel->name)
                    ->assertPathIs('/hotels/'.$hotel->slug)
                    ->click('.room-item-booking a')   
                    ->assertSee('Hotel booking')
                    ->assertPathIs('/room/'.$room->id.'/reservations/create');
            $browser->assertInputValue('full_name', '')
                    ->assertInputValue('phone', '')
                    ->assertInputValue('email', '')
                    ->assertInputValue('checkin', '')
                    ->select('duration', '1 night')
                    ->select('quantity', '1 room')
                    ->assertInputValue('request', '');
        }); 
    }

    /**
     * Test value page booking if user visit and no cache search.
     *
     * @return void
     */
    public function testValuePageBookingOfUserAndNoCache()
    {
        Cache::flush();
        $this->makeData(10);
        $hotel = Hotel::find(10);
        $this->makeRoom($hotel->id);
        $this->browse(function (Browser $browser) use ($hotel) {
            $selector = 'main section:nth-child(2) .container .row div:nth-child(2) .room-thumb .mask .content';
            $room = Room::orderby('price', 'ASC')->first();
            $user = User::find(1);
            $browser->loginAs($user)
                    ->visit('/')
                    ->clickLink('Hotels')
                    ->mouseover($selector)
                    ->whenAvailable($selector, function ($selectorAvailable) {
                        $selectorAvailable->click('.btn');
                    })
                    ->assertSee($hotel->name)
                    ->assertPathIs('/hotels/'.$hotel->slug)
                    ->click('.room-item-booking a')   
                    ->assertSee('Hotel booking')
                    ->assertPathIs('/room/'.$room->id.'/reservations/create');
            $browser->assertInputValue('full_name', $user->full_name)
                    ->assertInputValue('phone', $user->phone)
                    ->assertInputValue('email', $user->email)
                    ->assertInputValue('checkin', '')
                    ->select('duration', '1 night')
                    ->select('quantity', '1 room')
                    ->assertInputValue('request', '');
        }); 
    }

    /**
     * Test route page booking room if guest visit and has cache search.
     *
     * @return void
     */
    public function testValuePageBookingOfGuestAndHasCacheSearch()
    {
        Cache::flush();
        $this->makePlaceAndHotel();
        $hotel = Hotel::find(10);
        $this->makeRoom($hotel->id);
        $this->browse(function (Browser $browser) use ($hotel) {
            $selector = 'main section:nth-child(2) .container .row div:nth-child(2) .room-thumb .mask .content';
            $room = Room::orderby('price', 'ASC')->first();
            $browser->logout()
                    ->visit('/')
                    ->type('hotelSourceArea', 'Da Nang')
                    ->type('checkin', '30/09/2017')
                    ->select('duration', 2)
                    ->press('SEARCH')
                    ->mouseover($selector)
                    ->whenAvailable($selector, function ($selectorAvailable) {
                        $selectorAvailable->click('.btn');
                    })
                    ->assertSee($hotel->name)
                    ->assertPathIs('/hotels/'.$hotel->slug)
                    ->click('.room-item-booking a')   
                    ->assertSee('Hotel booking')
                    ->assertPathIs('/room/'.$room->id.'/reservations/create');
            $bookingInfomation = $browser->cookie(User::COOKIE_KEY);
            $browser->assertInputValue('full_name', '')
                    ->assertInputValue('phone', '')
                    ->assertInputValue('email', '')
                    ->assertInputValue('checkin', $bookingInfomation['checkin'])
                    ->select('duration', $bookingInfomation['duration'])
                    ->select('quantity', '1 room')
                    ->assertInputValue('request', '');
        }); 
    }

    /**
     * Test value page booking room if user visit and has cache search
     *
     * @return void
     */
    public function testValuePageBookingOfUserAndHasCacheSearch()
    {
        Cache::flush();
        $this->makePlaceAndHotel();
        $hotel = Hotel::find(10);
        $this->makeRoom($hotel->id);
        $this->browse(function (Browser $browser) use ($hotel) {
            $selector = 'main section:nth-child(2) .container .row div:nth-child(2) .room-thumb .mask .content';
            $room = Room::orderby('price', 'ASC')->first();
            $user = User::find(10);
            $browser->loginAs($user)
                    ->visit('/')
                    ->type('hotelSourceArea', 'Da Nang')
                    ->type('checkin', '30/09/2017')
                    ->select('duration', 2)
                    ->press('SEARCH')
                    ->mouseover($selector)
                    ->whenAvailable($selector, function ($selectorAvailable) {
                        $selectorAvailable->click('.btn');
                    })
                    ->assertSee($hotel->name)
                    ->assertPathIs('/hotels/'.$hotel->slug)
                    ->click('.room-item-booking a')   
                    ->assertSee('Hotel booking')
                    ->assertPathIs('/room/'.$room->id.'/reservations/create');
            $bookingInfomation = $browser->cookie(User::COOKIE_KEY);
            $browser->assertInputValue('full_name', $user->full_name)
                    ->assertInputValue('phone', $user->phone)
                    ->assertInputValue('email', $user->email)
                    ->assertInputValue('checkin', $bookingInfomation['checkin'])
                    ->select('duration', $bookingInfomation['duration'])
                    ->select('quantity', '1 room')
                    ->assertInputValue('request', '');
        }); 
    }

    /**
     * Test booking room success of guest.
     *
     * @return void
     */
    public function testBookingRoomSuccessOfGuest()
    {
        Cache::flush();
        $this->makeData(10);
        $hotel = Hotel::find(10);
        $this->makeRoom($hotel->id);
        $this->browse(function (Browser $browser) use ($hotel) {
            $selector = 'main section:nth-child(2) .container .row div:nth-child(2) .room-thumb .mask .content';
            $room = Room::orderby('price', 'ASC')->first();
            $browser->logout()
                    ->visit('/')
                    ->clickLink('Hotels')
                    ->mouseover($selector)
                    ->whenAvailable($selector, function ($selectorAvailable) {
                        $selectorAvailable->click('.btn');
                    })
                    ->assertSee($hotel->name)
                    ->assertPathIs('/hotels/'.$hotel->slug)
                    ->click('.room-item-booking a')   
                    ->assertSee('Hotel booking')
                    ->assertPathIs('/room/'.$room->id.'/reservations/create');
            $browser->type('full_name', 'Nguyen Cong Duoc')
                    ->type('phone', '01206223029')
                    ->type('email', 'duocnguyen@gmail.com')
                    ->select('duration', 3)
                    ->select('quantity', 2)
                    ->type('checkin', '1/10/2017')
                    ->type('request', 'I would like to have a room overlooking the beach')
                    ->press('SUBMIT')
                    ->waitFor('#booking-modal', 10)
                    ->whenAvailable('#booking-modal', function($modal) {
                        $modal->assertSee('You have successfully booked!');
                    });
            $guest = Guest::where('email', 'duocnguyen@gmail.com')->first();
            $this->assertDatabaseHas('guests', [
                'full_name' => $guest->full_name,
                'email' => $guest->email,
                'phone' => $guest->phone,
            ]);
            $this->assertDatabaseHas('reservations', [
                'room_id' => $room->id,
                'target' => 'guest',
                'target_id' => $guest->id,
                'status' => Reservation::STATUS_PENDING,
                'quantity' => 2,
                'checkin_date' => '2017-10-01 14:00:00',
                'checkout_date' => '2017-10-04 11:00:00',
                'request' => 'I would like to have a room overlooking the beach',
            ]); 
        });
    }

    /**
     * Test booking success of user.
     *
     * @return void
     */
    public function testBookingRoomSuccessOfUser()
    {
        Cache::flush();
        $this->makeData(10);
        $hotel = Hotel::find(10);
        $this->makeRoom($hotel->id);
        $this->browse(function (Browser $browser) use ($hotel) {
            $selector = 'main section:nth-child(2) .container .row div:nth-child(2) .room-thumb .mask .content';
            $room = Room::orderby('price', 'ASC')->first();
            $user = User::find(3);
            $browser->loginAs($user)
                    ->visit('/')
                    ->clickLink('Hotels')
                    ->mouseover($selector)
                    ->whenAvailable($selector, function ($selectorAvailable) {
                        $selectorAvailable->click('.btn');
                    })
                    ->assertSee($hotel->name)
                    ->assertPathIs('/hotels/'.$hotel->slug)
                    ->click('.room-item-booking a')   
                    ->assertSee('Hotel booking')
                    ->assertPathIs('/room/'.$room->id.'/reservations/create');
            $browser->assertInputValue('full_name', $user->full_name)
                    ->assertInputValue('phone', $user->phone)
                    ->assertInputValue('email', $user->email);
            $browser->select('duration', 3)
                    ->select('quantity', 2)
                    ->type('checkin', '1/10/2017')
                    ->type('request', 'I would like to have a room overlooking the beach')
                    ->press('SUBMIT')
                    ->waitFor('#booking-modal', 10)
                    ->whenAvailable('#booking-modal', function($modal) {
                        $modal->assertSee('You have successfully booked!');
                    });
            $this->assertDatabaseHas('reservations', [
                'room_id' => $room->id,
                'target' => 'user',
                'target_id' => $user->id,
                'status' => Reservation::STATUS_PENDING,
                'quantity' => 2,
                'checkin_date' => '2017-10-01 14:00:00',
                'checkout_date' => '2017-10-04 11:00:00',
                'request' => 'I would like to have a room overlooking the beach',
            ]); 
        });
    }

    /**
     * Test booking fail because room is not enough.
     *
     * @return void
     */
    public function testBookingRoomFail()
    {
        Cache::flush();
        $this->makeData(10);
        $hotel = Hotel::find(10);
        $this->makeRoom($hotel->id);
        $this->browse(function (Browser $browser) use ($hotel) {
            $selector = 'main section:nth-child(2) .container .row div:nth-child(2) .room-thumb .mask .content';
            $room = Room::orderby('price', 'ASC')->first();
            $user = User::find(3);
            $this->makeReservation($room->id);
            $browser->loginAs($user)
                    ->visit('/')
                    ->clickLink('Hotels')
                    ->mouseover($selector)
                    ->whenAvailable($selector, function ($selectorAvailable) {
                        $selectorAvailable->click('.btn');
                    })
                    ->assertSee($hotel->name)
                    ->assertPathIs('/hotels/'.$hotel->slug)
                    ->click('.room-item-booking a')   
                    ->assertSee('Hotel booking')
                    ->assertPathIs('/room/'.$room->id.'/reservations/create');
            $reservation = Reservation::find(1)->update(['status' => Reservation::STATUS_ACCEPTED]);
            $browser->select('duration', 3)
                    ->select('quantity', 10)
                    ->type('checkin', '1/10/2017')
                    ->type('request', 'I would like to have a room overlooking the beach')
                    ->press('SUBMIT')
                    ->assertSee('Sorry! The room is not enough!');
        });
    }

    /**
     * List case for test validation booking. 
     */
    public function listCaseTestValidationBookingRoom()
    {
        return [
            ['', '01206223029', 'duocnguyen@gmail.com', '1/10/2017', 'The full name field is required.'],
            ['Nguyen Cong Duoc', '', 'duocnguyen@gmail.com', '1/10/2017', 'The phone field is required.'],
            ['Nguyen Cong Duoc', '01206223029', '', '1/10/2017', 'The email field is required.'],
            ['Nguyen Cong Duoc', '01206223029', 'abcde', '1/10/2017', 'The email must be a valid email address.'],
            ['Nguyen Cong Duoc', '01206223029', 'duocnguyen@gmail.com', '', 'The checkin field is required.'],
        ];
    }

    /**
     *
     * @dataProvider listCaseTestValidationBookingRoom
     *
     */  
    public function testValidateBookingRoom($full_name, $phone, $email, $checkin, $expected)
    {   
        Cache::flush();
        $this->makeData(10);
        $hotel = Hotel::find(10);
        $this->makeRoom($hotel->id);
        $this->browse(function (Browser $browser) use ($full_name, $phone, $email, $checkin, $expected, $hotel) {
            $selector = 'main section:nth-child(2) .container .row div:nth-child(2) .room-thumb .mask .content';
            $room = Room::orderby('price', 'ASC')->first();
            $browser->logout()
                    ->visit('/')
                    ->clickLink('Hotels')
                    ->mouseover($selector)
                    ->whenAvailable($selector, function ($selectorAvailable) {
                        $selectorAvailable->click('.btn');
                    })
                    ->assertSee($hotel->name)
                    ->assertPathIs('/hotels/'.$hotel->slug)
                    ->click('.room-item-booking a')   
                    ->assertSee('Hotel booking')
                    ->assertPathIs('/room/'.$room->id.'/reservations/create');
            $browser->type('full_name', $full_name)
                    ->type('phone', $phone)
                    ->type('email', $email)
                    ->type('checkin', $checkin)
                    ->press('SUBMIT')
                    ->assertSee($expected)
                    ->assertPathIs('/room/'.$room->id.'/reservations/create');
        });
    }

    /**
     * Make data for test
     */
    public function makeData($row)
    {
        factory(User::class, $row)->create();
        factory(Place::class, $row)->create();
        $faker = Faker::create();
        $placeIds = Place::all('id')->pluck('id')->toArray();
        factory(Hotel::class, $row)->create([
            'place_id' => $faker->randomElement($placeIds)
        ]);
    }

    /**
     * Make data for test cache search.
     */
    public function makePlaceAndHotel()
    {   
        factory(User::class, 10)->create();
        $array = ['Ha Noi', 'Da Nang', 'Hue', 'Can Tho', 'Ho Chi Minh', 'Vung Tau','Ca Mau'];
        foreach ($array as $value) {
            factory(Place::class, 1)->create([
                'name' => $value
            ]);
        }
        factory(Hotel::class, 10)->create([
            'place_id' => 2
        ]);
    }

    /**
     * Make room of hotel for test.
     * 
     * @param $id id of hotel
     *
     * @return void
     */
    public function makeRoom($id)
    {
        factory(Room::class, 6)->create([
            'hotel_id' => $id,
            'total' => 10
        ]);
    }

    /**
     * Make reservation of room for test
     * 
     * @param $id id of room
     *
     * @return void
     */
    public function makeReservation($id)
    {
        factory(Reservation::class, 1)->create([
            'room_id' => $id,
            'quantity' => 10,
            'status' => 0,
            'checkin_date' => '2017-10-01 14:00:00',
            'checkout_date' => '2017-10-04 11:00:00'
        ]);
    }
}
