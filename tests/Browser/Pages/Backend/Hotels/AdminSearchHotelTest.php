<?php

namespace Tests\Browser\Pages\Backend\Hotels;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\Place;
use App\Model\Hotel;
use Faker\Factory as Faker;

class AdminSearchHotelTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     *Test search if not input value.
     *
     * @return void
     */
    public function testSearchNotInputValue()
    {
        $this->makeData(11);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/hotel')
                ->press('.btn-search')
                ->assertPathIs('/admin/hotel')
                ->assertQueryStringMissing('search');
            $paginateElement = $browser->elements('.pagination li');
            $numberPage = count($paginateElement) - 2;
            $this->assertTrue($numberPage == 2);
        });
    }

    /**
     *Test search if has input value and has one record.
     *
     * @return void
     */
    public function testSearchHasInputValue()
    {
        
        $this->makeData(9);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/hotel')
                ->type('search', 'Hotel 1')
                ->press('.btn-search')
                ->assertPathIs('/admin/hotel')
                ->assertQueryStringHas('search', 'Hotel 1')
                ->assertMissing('.pagination');
            $elements = $browser->elements('#table-contain tbody tr');
            $numAccounts = count($elements);
            $this->assertTrue($numAccounts == 1);
        });
    }
    
    /**
     *Test search has input value but not found.
     *
     * @return void
     */
    public function testSearchNotResult()
    {
        $this->makeData(10);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/hotel')
                ->type('search', 'The Laravel Framework')
                ->press('.btn-search')
                ->assertPathIs('/admin/hotel')
                ->assertSee('Data Not Found');
            $elements = $browser->elements('#table-contain tbody tr');
            $numAccounts = count($elements);
            $this->assertTrue($numAccounts == 0);
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
            $browser->visit('/admin/hotel')
                ->type('search', 'Hotel')
                ->press('.btn-search')
                ->assertPathIs('/admin/hotel');

            $elements = $browser->elements('#table-contain tbody tr');
            $totalRow = count($elements);
            $this->assertTrue($totalRow == 10);

            //check pagination
            $paginateActive = $browser->text('.pagination .active span');
            $this->assertTrue($paginateActive == '1'); 

            $page = $browser->click('.pagination li:nth-child(3) a');
            $page->assertPathIs('/admin/hotel')
                ->assertQueryStringHas('search', 'Hotel')
                ->assertQueryStringHas('page', 2);
                
            $elements = $page->elements('#table-contain tbody tr');
            $totalRow = count($elements);
            $this->assertTrue($totalRow == 5);

            $paginateActive = $browser->text('.pagination .active span');
            $this->assertTrue($paginateActive == '2'); 
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
                'name' => 'Hotel '.$i,
                'place_id' => $faker->randomElement($placeIds)
            ]);
        }
    }
}
