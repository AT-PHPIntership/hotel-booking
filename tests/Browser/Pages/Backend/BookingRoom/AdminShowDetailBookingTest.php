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
    public function testRouteShowBooking()
    {   
        $this->makeData(10);
        $reservation = Reservation::find(10);
        $this->browse(function (Browser $browser) use ($reservation) {
            $browser->visit('/admin/reservation')
                    ->click('#table-contain tbody tr:nth-child(1) td:nth-child(8) .fa-search-plus')
                    ->assertSee('DETAIL BOOKING ROOM')
                    ->assertPathIs('/admin/reservation/' . $reservation->id);
        });
    }

    /**
     * Test show detail booking.
     *
     * @return void
     */
    public function testShowDetailBooking()
    {
        $this->makeData(15);
        $columns = [
            'reservations.id',
            'status',
            'room_id',
            'target',
            'target_id',
            'checkin_date',
            'checkout_date',
            'quantity',
            'request'
        ];
        $reservation = Reservation::select($columns)
            ->with(['room' => function ($query) {
                $query->select('rooms.id', 'rooms.name', 'rooms.hotel_id');
            }, 'reservable', 'room.hotel'])
            ->findOrFail(15);
        $this->browse(function (Browser $browser) use ($reservation) {
            $browser->visit('/admin/reservation')
                    ->click('#table-contain tbody tr:nth-child(1) td:nth-child(8) .fa-search-plus')
                    ->assertPathIs('/admin/reservation/' . $reservation->id);
            $this->assertTrue($browser->text('.table tbody tr:nth-child(1) td:nth-child(2)') === $reservation->room->hotel->name);
            $this->assertTrue($browser->text('.table tbody tr:nth-child(2) td:nth-child(2)') === $reservation->room->name);
            $this->assertTrue($browser->text('.table tbody tr:nth-child(3) td:nth-child(2)') === $reservation->reservable->full_name);
            $this->assertTrue($browser->text('.table tbody tr:nth-child(4) td:nth-child(2)') === $reservation->reservable->email);
            $this->assertTrue($browser->text('.table tbody tr:nth-child(5) td:nth-child(2)') === $reservation->reservable->phone);
            $this->assertTrue($browser->text('.table tbody tr:nth-child(6) td:nth-child(2)') === (string)$reservation->quantity);
            $this->assertTrue($browser->text('.table tbody tr:nth-child(7) td:nth-child(2)') === $reservation->checkin_date);
            $this->assertTrue($browser->text('.table tbody tr:nth-child(8) td:nth-child(2)') === $reservation->checkout_date);
            $this->assertTrue($browser->text('.table tbody tr:nth-child(9) td:nth-child(2)') === (string)$reservation->request);
            $this->assertTrue($browser->text('.table tbody tr:nth-child(10) td:nth-child(2)') === $reservation->status_label);
        });
    }

    /**
     * Test display button Edit.
     *
     * @return void
     */
    public function testShowButtonEdit()
    {
        $this->makeData(15);
        $reservation = Reservation::select('status')->find(15);
        $this->browse(function (Browser $browser) use ($reservation) {
            $browser->visit('/admin/reservation')
                    ->click('#table-contain tbody tr:nth-child(1) td:nth-child(8) .fa-search-plus');
            if($reservation->status_label != 'Canceled') {
                $browser->assertVisible('.btn-primary');
            } else {
                $browser->assertMissing('.btn-primary');
            }         
        });
    }

    /**
     * Test button Back.
     *
     * @return void
     */
    public function testButtonBack()
    {
        $this->makeData(15);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/reservation')
                    ->click('#table-contain tbody tr:nth-child(1) td:nth-child(8) .fa-search-plus')
                    ->clickLink('Back')
                    ->assertPathIs('/admin/reservation'); 
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
