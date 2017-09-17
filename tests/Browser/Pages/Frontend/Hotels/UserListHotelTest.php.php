<?php

namespace Tests\Browser\Pages\Frontend\Hotels;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\Place;
use App\Model\Hotel;
use Faker\Factory as Faker;

class UserListHotelTest extends DuskTestCase
{
    use DatabaseMigrations;
    
    /**
     * A Dusk test content.
     *
     * @return void
     */
    public function testListHotels()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('Hotels')
                    ->assertSee('List Hotels')
                    ->assertPathIs('/hotel')
                    ->assertTitle('LIST HOTELS');
        });
    }

    /**
     * A Dusk test show record with table empty.
     *
     * @return void
     */
    public function testListEmpty()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/hotel')
                ->assertSee('List Hotels')
                ->assertTitle('LIST HOTELS');
            $elements = $browser->elements('.rooms.mt50 .container .row .col-sm-4');
            $this->assertCount(0, $elements);
            $this->assertNull($browser->element('.paginate'));
        });
    }

    /**
     * A Dusk test show record with table has data.
     *
     * @return void
     */
    public function testListHasRecord()
    {
        $this->makeData(11);
        $this->browse(function (Browser $browser) {
            $browser->visit('/hotel')
                ->assertSee('List Hotels')
                ->assertTitle('LIST HOTELS');
            $elements = $browser->elements('.rooms.mt50 .container .row .col-sm-4');
            $this->assertCount(11, $elements);
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
        $this->makeData(25);
        $this->browse(function (Browser $browser) {
            $browser->visit('/hotel')
                ->assertSee('List Hotels')
                ->assertTitle('LIST HOTELS');
            //Count item number in one page    
            $elements = $browser->elements('.rooms.mt50 .container .row .col-sm-4');
            $this->assertCount(12, $elements);
            $this->assertNotNull($browser->element('.pagination'));
            //Count page number of pagination
            $paginate_element = $browser->elements('.pagination li');
            $number_page = count($paginate_element)- 2;
            $this->assertTrue($number_page == 3);
        });
    }

    /**
     * Test click page 2 in pagination link
     *
     * @return void
     */
    public function testPathPagination()
    {   
        $this->makeData(14);
        $this->browse(function (Browser $browser) {
            $browser->visit('/hotel?page=2')
                ->assertSee('List Hotels')
                ->assertTitle('LIST HOTELS');
            $elements = $browser->elements('.rooms.mt50 .container .row .col-sm-4');
            $this->assertCount(2, $elements);
            $browser->assertPathIs('/hotel');
            $browser->assertQueryStringHas('page', 2);
        });
    }
    
    /**
     * Make data for test.
     *
     * @return void
     */
    public function makeData($row)
    {   
        factory(Place::class, 10)->create();
        $placeIds = Place::all('id')->pluck('id')->toArray();
        $faker = Faker::create();
        for ($i = 0; $i < $row; $i++) {
            factory(Hotel::class, 1)->create([
                'place_id' => $faker->randomElement($placeIds)
            ]);
        };
    }
}
