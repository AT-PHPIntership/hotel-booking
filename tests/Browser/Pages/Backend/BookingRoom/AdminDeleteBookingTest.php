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
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AdminDeleteBookingTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test delete a booking room success.
     *
     * @return void
     */
    public function testDeleteSuccess()
    {   
        $this->makeData(10);
        $this->browse(function (Browser $browser) {
            $reservation = Reservation::find(10);
            $browser->visit('/admin/reservation')
                    ->click('#table-contain tbody tr:nth-child(1) td:nth-child(8) .fa-trash-o')
                    ->waitForText('Confirm deletion!')
                    ->press('Delete')
                    ->assertSee('Delete Booking Room Success!')
                    ->assertPathIs('/admin/reservation');
            $this->assertTrue($browser->text('#table-contain tbody tr:nth-child(1) td:nth-child(1)') != $reservation->id);
            $this->assertSoftDeleted('reservations', [
            'id' => $reservation->id]); 
        });
    }

    /**
     * Test 404 Page Not found when delete booking.
     *
     * @return void
     */
    public function testError404()
    {   
        $this->makeData(10);
        $this->browse(function (Browser $browser) {
            $reservation = Reservation::find(10);
            $browser->visit('admin/reservation')
                    ->click('#table-contain tbody tr:nth-child(1) td:nth-child(8) .fa-trash-o');
            $reservation->delete();
            $browser->waitForText('Confirm deletion!')
                    ->press('Delete')
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
