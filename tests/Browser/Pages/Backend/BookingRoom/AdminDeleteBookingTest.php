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
            for ($i=1, $j=10; $i <= 10; $i++) { 
                $browser->visit('/admin/reservation');
                $status = $browser->text('#table-contain tbody tr:nth-child('.$j. ') td:nth-child(7)');
                $id = $browser->text('#table-contain tbody tr:nth-child('.$j. ') td:nth-child(1)');
                if ($status == 'Canceled') {
                    $browser->click('#table-contain tbody tr:nth-child('.$j. ') td:nth-child(8) .fa-trash-o')
                            ->waitForText('Confirm deletion!')
                            ->press('Delete')
                            ->assertSee('Delete Booking Room Success!')
                            ->assertPathIs('/admin/reservation');
                    $browser->assertDontSeeIn('#table-contain tbody tr:nth-child('.$j. ') td:nth-child(1)', $id);
                    $this->assertSoftDeleted('reservations', [
                    'id' => $id]); 
                }
                $j--;
            }
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
            for ($i=1, $j=10; $i <= 10; $i++) { 
                $browser->visit('/admin/reservation');
                $status = $browser->text('#table-contain tbody tr:nth-child('.$j. ') td:nth-child(7)');
                $id = $browser->text('#table-contain tbody tr:nth-child('.$j. ') td:nth-child(1)');
                if ($status == 'Canceled') {
                    Reservation::find($id)->delete();
                    $browser->click('#table-contain tbody tr:nth-child('.$j. ') td:nth-child(8) .fa-trash-o')
                            ->waitForText('Confirm deletion!')
                            ->press('Delete')
                            ->assertSee('404 - Page Not found')
                            ->assertPathIs('/admin/reservation/' .$id);
                }
                $j--;
            }
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
