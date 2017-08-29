<?php

namespace Tests\Browser\Pages\Backend\Services;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\Service;
use App\Model\Hotel;
use App\Model\Place;
use App\Model\HotelService;

class AdminDeleteServiceTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Init data for test
     */
    public function setUp()
    {
        parent::setUp();
        Service::create([
            'name' => 'Wifi',
        ]);

        factory(Place::class, 1 )->create();

        factory(Hotel::class, 1)->create([
            'place_id'=> '1'
        ]);
     
        for ($i = 0; $i < 5; $i++) {
            $hotel = factory(hotelService::class, 1)->create([
                'service_id'=> '1',
                'hotel_id'=> '1',
            ]);
        }
    }

    /**
     * Click button delete service from list service
     * @param Browser $browser instance of browser
     * @return $page page after action click delete
     */
    public function clickButtonDeleteService($browser)
    {
        $page = $browser->visit('/admin/service')
            ->press('#table-contain tbody tr:nth-child(1) td:nth-child(3) button')
            ->waitForText("Confirm deletion!")
            ->press('Delete')
            ->assertSee("Delete success");
        return $page;
    }

    /**
     * Test delete service success
     *
     * @return void
     */
    public function testDeleteSuccess() 
    {
        $this->browse(function (Browser $browser) {
            $page = $this->clickButtonDeleteService($browser);
            $page->assertDontSee('Wifi');
            $this->assertSoftDeleted('services', ['id' => '1']);
            $elements = $page->elements('#table-contain tbody tr');
            $this->assertCount(0, $elements);
        });
    } 

    /**
     * Test not found service
     *
     * @return void
     */
    public function testNotFound()
    {
        $this->browse(function (Browser $browser) {
            $page = $browser->visit('/admin/service');
            $service = Service::find(1);
            $service->delete();
            $page->press('#table-contain tbody tr:nth-child(1) td:nth-child(3) button')
                ->waitForText("Confirm deletion!")
                ->press('Delete')
                ->assertSee("404 - Page Not found");
        });  
    }

    /**
     * 
     * Test delete hotelservice belong to service
     * 
     * @return void
     */
    public function testDeleteRelationship()
    {
        $service = Service::find(1);
        $countHotelServices = $service->hotelServices()->count();
        $this->assertEquals(5, $countHotelServices);

        $this->browse(function (Browser $browser) {
            $this->clickButtonDeleteService($browser);
        });

        $countHotelServices = $service->hotelServices()->count(); 
        $this->assertEquals(0, $countHotelServices);
    }
}
