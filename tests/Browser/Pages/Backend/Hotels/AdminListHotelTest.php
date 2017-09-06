<?php
namespace Tests\Browser\Pages\Backend\Hotels;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\Place;
use App\Model\Hotel;
use Faker\Factory as Faker;
class AdminListHotelTest extends DuskTestCase
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
            $browser->visit('/admin')
                    ->clickLink('Hotels')
                    ->assertSee('List of hotels')
                    ->assertPathIs('/admin/hotel');
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
            $browser->visit('/admin/hotel')
                ->assertSee('List of hotels');
            $elements = $browser->elements('#table-contain tbody tr');
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
        $this->makeData(9);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/hotel')
                ->resize(1920, 2000)
                ->assertSee('List of hotels');
            $elements = $browser->elements('#table-contain tbody tr');
            $this->assertCount(9, $elements);
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
        $this->makeData(21);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/hotel')
                ->resize(1920, 2000)
                ->assertSee('List of hotels');
            //Count row number in one page    
            $elements = $browser->elements('#table-contain tbody tr');
            $this->assertCount(10, $elements);
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
        $this->makeData(12);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/hotel?page=2');
            $elements = $browser->elements('#table-contain tbody tr');
            $this->assertCount(2, $elements);
            $browser->assertPathIs('/admin/hotel');
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
        }
    }
}