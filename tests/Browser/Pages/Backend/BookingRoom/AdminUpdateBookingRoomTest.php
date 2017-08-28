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

class AdminUpdateBookingRoomTest extends DuskTestCase
{   
    use DatabaseMigrations;

    /**
     * Test show link edit reservation in page index.
     *
     * @return void
     */
    public function testShowLinkEditReservation()
    {   
        $this->makeData(10);
        $this->browse(function (Browser $browser) {
            for ($i=1; $i <= 10; $i++) {
                $browser->visit('/admin/reservation');
                $status = $browser->text('#table-contain tbody tr:nth-child('.$i. ') td:nth-child(7)');
                $element = $browser->element('#table-contain tbody tr:nth-child('.$i. ') td:nth-child(8) a:nth-child(2)')->getAttribute('class');
                $value = explode(' ', $element);
                if ($status != 'Canceled') {
                    count($value) == 5;
                    $browser->assertPathIs('/admin/reservation')
                            ->assertSee('List Booking Rooms');      
                } 
                else {
                    count($value) == 6;
                    $browser->assertPathIs('/admin/reservation')
                            ->assertSee('List Booking Rooms');
                }
            }
        });
    }

    /**
     * Test route page edit a booking room in page index booking room.
     *
     * @return void
     */
    public function testEditReservation()
    {   
        $this->makeData(10);
        $this->browse(function (Browser $browser) {
            for ($i=1; $i <= 10; $i++) { 
                $browser->visit('/admin/reservation');
                $status = $browser->text('#table-contain tbody tr:nth-child('.$i. ') td:nth-child(7)');
                $id = $browser->text('#table-contain tbody tr:nth-child('.$i. ') td:nth-child(1)');
                if ($status != 'Canceled') {
                    $browser->click('#table-contain tbody tr:nth-child('.$i. ') td:nth-child(8) .fa-pencil-square-o')
                        ->assertSee('Update Reservation')
                        ->assertPathIs('/admin/reservation/'.$id.'/edit');
                }
            }
        });
    }

    /**
     * Test route page edit a booking room in page show  a booking room.
     *
     * @return void
     */
    public function testEditReservationExample()
    {   
        $this->makeData(10);
        $this->browse(function (Browser $browser) {
            
            for ($i=1; $i <= 10; $i++) { 
                $browser->visit('/admin/reservation');
                $status = $browser->text('#table-contain tbody tr:nth-child('.$i. ') td:nth-child(7)');
                $id = $browser->text('#table-contain tbody tr:nth-child('.$i. ') td:nth-child(1)');
                if ($status != 'Canceled') {
                    $browser->click('#table-contain tbody tr:nth-child('.$i. ') td:nth-child(8) .fa-search-plus')
                            ->clickLink('Edit')
                            ->assertSee('Update Reservation')
                            ->assertPathIs('/admin/reservation/'.$id. '/edit');
                }
            }
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
            $browser->visit('/admin/reservation');
            for ($i=1; $i <= 10; $i++) { 
                $status = $browser->text('#table-contain tbody tr:nth-child('.$i. ') td:nth-child(7)');
                $id = $browser->text('#table-contain tbody tr:nth-child('.$i. ') td:nth-child(1)');
                if ($status != 'Canceled') {
                    $browser->click('#table-contain tbody tr:nth-child('.$i. ') td:nth-child(8) .fa-pencil-square-o')
                            ->select('status')
                            ->press('Submit')
                            ->assertSee('Edit Booking Room Success!')
                            ->assertPathIs('/admin/reservation');
                }
            }
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
        
            for ($i=1; $i <= 10; $i++) {
                $browser->visit('/admin/reservation');
                $status = $browser->text('#table-contain tbody tr:nth-child('.$i. ') td:nth-child(7)');
                $id = $browser->text('#table-contain tbody tr:nth-child('.$i. ') td:nth-child(1)');
                if ($status != 'Canceled') {
                    $browser->click('#table-contain tbody tr:nth-child('.$i. ') td:nth-child(8) .fa-pencil-square-o')
                            ->select('status')
                            ->press('Reset')
                            ->assertSee($status)
                            ->assertPathIs('/admin/reservation/' .$id. '/edit');
                }
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
        $this->makeData(10);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/reservation');
            for ($i=1; $i <= 10; $i++) { 
                $status = $browser->text('#table-contain tbody tr:nth-child('.$i. ') td:nth-child(7)');
                $id = $browser->text('#table-contain tbody tr:nth-child('.$i. ') td:nth-child(1)');
                if ($status != 'Canceled') {
                    $browser->click('#table-contain tbody tr:nth-child('.$i. ') td:nth-child(8) .fa-pencil-square-o')
                            ->clickLink('Back')
                            ->assertSee('List Booking Rooms')
                            ->assertPathIs('/admin/reservation');
                }
            }
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
            for ($i=1, $j=10; $i <= 10; $i++) {
                $browser->visit('/admin/reservation');
                $status = $browser->text('#table-contain tbody tr:nth-child(' .$j. ') td:nth-child(7)');
                $id = $browser->text('#table-contain tbody tr:nth-child(' .$j. ') td:nth-child(1)');
                if ($status != 'Canceled') {
                    $browser->click('#table-contain tbody tr:nth-child(' .$j. ') td:nth-child(8) .fa-pencil-square-o');
                    Reservation::find($id)->delete();
                    $browser->select('status')
                            ->press('Submit')
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
