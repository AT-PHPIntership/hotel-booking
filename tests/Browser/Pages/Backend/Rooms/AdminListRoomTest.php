<?php
namespace Tests\Browser\Pages\Backend\Rooms;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\Room;
use App\Model\Hotel;
use App\Model\Place;
use Faker\Factory as Faker;

class AdminListRoomTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Make rooms for hotel
     */
    public function makeRoomOfHotel($idHotel, $row)
    {
        factory(Place::class, 5)->create();
        $placeIds = Place::all('id')->pluck('id')->toArray();
        $faker = Faker::create();
        for ($i = 0; $i < $idHotel; $i++) {
            factory(Hotel::class, 1)->create([
                'place_id' => $faker->randomElement($placeIds)
            ]);
        }
        for ($i = 0; $i < $row; $i++) {
            factory(Room::class, 1)->create([
                'hotel_id' => $idHotel,
            ]);
        }
    }

     /**
     * A Dusk test show record with table empty.
     *
     * @return void
     */
    public function testShowEmpty()
    {
        $this->browse(function (Browser $browser) {
            $this->makeRoomOfHotel(1, 0);
            $browser->visit('/admin/hotel/1/room')
                    ->assertPathIs('/admin/hotel/1/room')
                    ->assertTitle('Admin | Room')
                    ->assertSee('List Rooms');
            $elements = $browser->elements('#table-contain tbody tr');
            $row = count($elements);
            $this->assertTrue($row == 0);
            $this->assertNull($browser->element('.pagination'));
        });
    }

     /**
     * A Dusk test show record with table has data.
     *
     * @return void
     */
    public function testShowRecord()
    {
        $this->makeRoomOfHotel(1, 9);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/hotel/1/room')
                    ->resize(1920, 2000)
                    ->assertPathIs('/admin/hotel/1/room')
                    ->assertTitle('Admin | Room')
                    ->assertSee('List Rooms');
            $elements = $browser->elements('#table-contain tbody tr');
            $row = count($elements);
            $this->assertTrue($row == 9);
            $this->assertNull($browser->element('.pagination'));
        });
    }
    /**
     * A Dusk test show record with table has data and ensure pagnate.
     *
     * @return void
     */
    public function testShowRecordPaginate()
    {
        $this->makeRoomOfHotel(1, 11);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/hotel/1/room')
                    ->resize(1920, 2000)
                    ->assertPathIs('/admin/hotel/1/room')
                    ->assertTitle('Admin | Room')
                    ->assertSee('List Rooms');
            $elements = $browser->elements('#table-contain tbody tr');
            $row = count($elements);
            $this->assertTrue($row == 10);
            $this->assertNotNull($browser->element('.pagination'));
        });
    }

    /**
     * Test click page 2 in pagination link
     *
     * @return void
     */
    public function testPathPagination()
    {   
        $this->makeRoomOfHotel(1, 12);
        $this->browse(function (Browser $browser) {
            $page = $browser->visit('/admin/hotel/1/room');
            $page->click('.pagination li:nth-child(3) a');
            $elements = $page->elements('#table-contain tbody tr');
            $this->assertCount(2, $elements);
            $browser->assertPathIs('/admin/hotel/1/room')
                    ->assertTitle('Admin | Room');
            $browser->assertQueryStringHas('page', 2);
        });
    }

}
