<?php

namespace Tests\Browser\Pages\Backend\BookingRoom;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\Room;
use App\Model\Reservation;
use App\Model\Hotel;
use App\Model\Place;
use App\Model\Guest;
use App\Model\User;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class AdminUpdateBookingRoomTest extends DuskTestCase
{   
    use DatabaseMigrations;

    /**
     * Test route page edit a booking room in page index.
     *
     * @return void
     */
    public function testEditReservation()
    {   
        $this->makeData(10);
        $this->browse(function (Browser $browser) {
            $reservation = Reservation::find(10);
            $browser->visit('/admin/reservation')
                    ->click('#table-contain tbody tr:nth-child(1) td:nth-child(8) a:nth-child(2)')
                    ->assertSee('Update Reservation')
                    ->assertPathIs('/admin/reservation/' .$reservation->id. '/edit');
        });
    }

    /**
     * Test route page edit a booking room in page show detail booking room.
     *
     * @return void
     */
    public function testEditReservationInShowDetail()
    {   
        $this->makeData(10);
        $this->browse(function (Browser $browser) {
            $reservation = Reservation::find(10);
            $browser->visit('/admin/reservation')
                    ->click('#table-contain tbody tr:nth-child(1) td:nth-child(8) a:nth-child(1)')
                    ->assertSee('DETAIL BOOKING ROOM')
                    ->assertPathIs('/admin/reservation/' .$reservation->id)
                    ->clickLink('Edit')
                    ->assertSee('Update Reservation')
                    ->assertPathIs('/admin/reservation/' .$reservation->id. '/edit');
        });
    }

    /**
     * Test Edit success a booking room.
     *
     * @return void
     */ 
    public function testEditReservationSuccess()
    {   
        $this->makeData(10);
        $this->browse(function (Browser $browser) {
            $reservation = Reservation::find(10);
            $browser->visit('/admin/reservation')
                    ->click('#table-contain tbody tr:nth-child(1) td:nth-child(8) .fa-pencil-square-o')
                    ->assertSelected('status', $reservation->status)
                    ->select('status', '0')
                    ->press('Submit')
                    ->assertSee('Edit Booking Room Success!')
                    ->assertPathIs('/admin/reservation');
            $this->assertTrue($browser->text('#table-contain tbody tr:nth-child(1) td:nth-child(7)') === 'Pending');
        });
    }

    /**
     * Test button Reset.
     *
     * @return void
     */
    public function testButtonReset()
    {   
        $this->makeData(10);
        $this->browse(function (Browser $browser) {
            $reservation = Reservation::find(10);
            $browser->visit('/admin/reservation')
                    ->click('#table-contain tbody tr:nth-child(1) td:nth-child(8) .fa-pencil-square-o')
                    ->select('status')
                    ->press('Reset')
                    ->assertSelected('status', $reservation->status)
                    ->assertPathIs('/admin/reservation/' .$reservation->id. '/edit');
        });
    }

    /**
     * Test button Back.
     *
     * @return void
     */
    public function testButtonBack()
    {   
        $this->makeData(10);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/reservation')
                    ->click('#table-contain tbody tr:nth-child(1) td:nth-child(8) .fa-pencil-square-o')
                    ->clickLink('Back')
                    ->assertSee('List Booking Rooms')
                    ->assertPathIs('/admin/reservation');
        });
    }

    /**
     * Test Error 404 - Page not found.
     *
     * @return void
     */
    public function testError404()
    {   
        $this->makeData(10);
        $this->browse(function (Browser $browser) {
            $reservation = Reservation::find(10);
            $browser->visit('/admin/reservation')
                    ->click('#table-contain tbody tr:nth-child(1) td:nth-child(8) .fa-pencil-square-o');
            $reservation->delete();
            $browser->press('Submit')
                    ->assertSee('404 - Page Not found')
                    ->assertPathIs('/admin/reservation/' .$reservation->id);
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
    }
}
