<?php

namespace Tests\Browser\Pages\Backend\BookingRoom;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\Room;
use App\Model\Reservation;
use App\Model\Hotel;
use App\Model\Place;
use App\Model\User;
use App\Model\Guest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AdminShowDetailBookingTest extends DuskTestCase
{   
    use DatabaseMigrations;

    /**
     * Test route page show detail booking.
     *
     * @return void
     */
    // public function testRouteShowBooking()
    // {   
    //     $this->makeData(10);
    //     $reservation = Reservation::find(10);
    //     $this->browse(function (Browser $browser) use ($reservation) {
    //         $browser->visit('/admin/reservation')
    //                 ->click('#table-contain tbody tr:nth-child(1) td:nth-child(7) .fa-search-plus')
    //                 ->assertSee('DETAIL BOOKING ROOM')
    //                 ->assertPathIs('/admin/reservation/' . $reservation->id);
    //     });
    // }

    /**
     * Test show detail booking.
     *
     * @return void
     */
    public function testShowDetailBooking()
    {
        $this->makeData(15);
        $reservation = Reservation::with(['bookingroom' => function ($query) {
                        $query->select('rooms.id', 'name', 'rooms.hotel_id');
                        }])
                        ->findOrFail(15);
        $hotelId = $reservation->bookingroom->hotel_id;
        $hotel = Hotel::select('name')
                    ->where('id', $hotelId)
                    ->firstOrFail(); 
        if ($reservation->target == 'user') {
            $user = User::select('full_name', 'email', 'phone')
                        ->where('id', $reservation->target_id)
                        ->firstOrFail();
        } else {
            $user = Guest::select('full_name', 'email', 'phone')
                        ->where('id', $reservation->target_id)
                        ->firstOrFail();
        }
        $this->browse(function (Browser $browser) use ($reservation, $hotel, $user) {
            $browser->visit('/admin/reservation')
                    ->click('#table-contain tbody tr:nth-child(1) td:nth-child(7) .fa-search-plus')
                    ->assertPathIs('/admin/reservation/' . $reservation->id);
            dd($hotel->name);   
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
        factory(Guest::class, $row)->create();
        factory(User::class, $row)->create();
        $placeIds = Place::all('id')->pluck('id')->toArray();
        $faker = Faker::create();
        for ($i = 0; $i < $row; $i++) {
            factory(Hotel::class, 1)->create([
                'place_id' => $faker->randomElement($placeIds)
            ]);
        }
        $hotelIds = Hotel::all('id')->pluck('id')->toArray();
        $faker = Faker::create();
        for ($i = 0; $i < $row; $i++) {
            factory(Room::class, 1)->create([
                'hotel_id' => $faker->randomElement($hotelIds),
            ]);
        }
        $roomIds = Room::all('id')->pluck('id')->toArray();
        $faker = Faker::create();
        for ($i = 0; $i < $row; $i++) {
            factory(Reservation::class, 1)->create([
                'room_id' => $faker->randomElement($roomIds),
            ]);
        }
    }
}
