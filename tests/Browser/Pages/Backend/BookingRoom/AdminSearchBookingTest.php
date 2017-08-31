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
use Faker\Factory as Faker;

class AdminSearchBookingTest extends DuskTestCase
{   
    use DatabaseMigrations;

    /**
     *Test search if not input value.
     *
     * @return void
     */
    public function testSearchNotInputValue()
    {
        $this->makeData(15);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/reservation')
                    ->press('.btn-search')
                    ->assertPathIs('/admin/reservation')
                    ->assertQueryStringMissing('search');
            $paginate_element = $browser->elements('.pagination li');
            $number_page = count($paginate_element) - 2;
            $this->assertTrue($number_page == 2);
        });
    }

    /**
     *Test search if has input value and has one record.
     *
     * @return void
     */
    public function testSearchHasInputValue()
    {
        $this->makeData(15);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/reservation')
                    ->assertVisible('.pagination')
                    ->type('search', 'Room9')
                    ->press('.btn-search');
            $elements = $browser->elements('#table-contain tbody tr');
            $numAccounts = count($elements);
            $this->assertTrue($numAccounts == 1);
            $browser->assertPathIs('/admin/reservation')
                    ->assertQueryStringHas('search', 'Room9')
                    ->assertMissing('.pagination'); 
        });
    }

    /**
     *Test search has input value but not found.
     *
     * @return void
     */
    public function testSearchNotResult()
    {
        $this->makeData(15);
        $this->browse(function (Browser $browser) {     
            $browser->visit('/admin/reservation')
                    ->assertVisible('.pagination')
                    ->type('search', 'Hello')
                    ->press('.btn-search');
            $elements = $browser->elements('#table-contain tbody tr');
            $numAccounts = count($elements);
            $this->assertTrue($numAccounts == 0);
            $browser->assertSee('Data Not Found')
                    ->assertPathIs('/admin/reservation')
                    ->assertQueryStringHas('search', 'Hello')
                    ->assertMissing('.pagination');
        });
    }

    /**
     *Test search has input value and has many record.
     *
     * @return void
     */
    public function testHasManyRecord()
    {
        $this->makeData(15);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/reservation')
                    ->type('search', 'Room')
                    ->press('.btn-search');
            $elements = $browser->elements('#table-contain tbody tr');        
            $numAccounts = count($elements);
            $this->assertTrue($numAccounts == 10);
            $browser->assertPathIs('/admin/reservation')
                    ->assertQueryStringHas('search', 'Room');
            $paginate_element = $browser->elements('.pagination li');
            $number_page = count($paginate_element) - 2;
            $this->assertTrue($number_page == 2);

            $elements = $browser->click('.pagination li:nth-child(3) a')
                                ->elements('#table-contain tbody tr');
            $numAccounts = count($elements);
            $this->assertTrue($numAccounts == 5);
            $browser->assertPathIs('/admin/reservation')
                    ->assertQueryStringHas('search', 'Room')
                    ->assertQueryStringHas('page', '2');
            $paginate_element = $browser->elements('.pagination li');
            $number_page = count($paginate_element) - 2;
            $this->assertTrue($number_page == 2);
        }); 
    }

    /**
     * Make data for test
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
                'name' => 'Room'.$i
            ]);
        }
        $roomIds = Room::all('id')->pluck('id')->toArray();
        for ($i = 1; $i <= $row; $i++) {
            factory(Reservation::class, 1)->create([
                'room_id' => $i,
            ]);
        }
    }
}
