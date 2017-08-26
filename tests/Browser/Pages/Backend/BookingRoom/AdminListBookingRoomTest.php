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

class AdminListBookingRoomTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test view Admin List Booking Room.   
     *
     * @return void
     */
    public function testListBooking()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin')
                    ->clickLink('Booking Room')
                    ->assertSee('List Booking Rooms')
                    ->assertPathIs('/admin/reservation');
        });
    }

    /**
     * Test if DataBase has 0 record.
     *
     * @return void
     */
    public function testHasZeroRecordListBooking()
    {   
        $this->browse(function (Browser $browser) {
            $elements = $browser->visit('/admin/reservation')
                ->elements('#table-contain tbody tr');
            $numAccounts = count($elements);
            $this->assertTrue($numAccounts == 0);
            $browser->assertPathIs('/admin/reservation')
                    ->assertSee('Data Not Found')
                    ->assertMissing('.pagination');
        });
    }

    /**
     * Test if DataBase has data.
     *
     * @return void
     */
    public function testHasDataListBooking()
    {   
        $this->makeData(10);
        $this->browse(function (Browser $browser) {
            $elements = $browser->visit('/admin/reservation')
                 ->elements('#table-contain tbody tr');
            $numAccounts = count($elements);
            $this->assertTrue($numAccounts == 10);
            $browser->assertPathIs('/admin/reservation')
                    ->assertMissing('.pagination');
            $browser->visit('/admin/reservation?page=2')
                    ->assertSee('Data Not Found');
        });
    }

    /**
     * Test if DataBase has  > 10 record.
     *
     * @return void
     */
    public function testHasMoreDataListBooking()
    {  
        $this->makeData(15);
        $this->browse(function (Browser $browser) {
            $elements = $browser->visit('/admin/reservation?page=1')
                        ->elements('#table-contain tbody tr');
            $numAccounts = count($elements);
            $this->assertTrue($numAccounts == 10);
            $browser->assertPathIs('/admin/reservation');
            $browser->assertQueryStringHas('page', '1');
            
            $elements = $browser->visit('/admin/reservation?page=2')
                 ->elements('#table-contain tbody tr');
            $numAccounts = count($elements);
            $this->assertTrue($numAccounts == 5);
            $browser->assertPathIs('/admin/reservation');
            $browser->assertQueryStringHas('page', '2');
        });
    }

    /**
     * Test button Pagination.
     *
     * @return void
     */
    public function testButtonPaginate()
    {
        $this->makeData(25);
        $this->browse(function (Browser $browser) {
        $paginate_element = $browser->visit('/admin/reservation')
                                    ->resize(1920, 2000)           
                                    ->elements('.pagination li');
        $number_page = count($paginate_element) - 2;
        $this->assertTrue($number_page == 3);
        });
    }

    /**
     * Test link show detail user.
     *
     * @return void
     */
    public function testLinkDetailUser()
    {
        $this->makeData(10);
        $this->browse(function (Browser $browser) {
                $browser->visit('/admin/reservation')
                    ->click('#id-user-detail')
                    ->assertPathIsNot('/admin/reservation');
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
