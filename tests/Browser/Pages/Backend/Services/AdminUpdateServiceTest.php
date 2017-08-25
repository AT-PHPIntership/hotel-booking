<?php

namespace Tests\Browser\Pages\Backend\Places;

use App\Model\Service;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class AdminUpdatePlaceTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        Service::create([
            'name' => 'Massage',
        ]);
        
    }

    public function clickUpdateService($browser, $service)
    {   
        $page = $browser->visit('/admin/service')
            ->press('#table-contain tbody tr:nth-child(1) td:nth-child(3) a')
            ->assertPathIs('/admin/service/' . $service->id . '/edit')
            ->assertSee('Update service');
        return $page;
    }
    
    /**
     * Test value for each input in edit form.
     *
     * @return void
     */
    public function testValueEditService()
    {
        $this->browse(function (Browser $browser) {
            $service = Service::find(1);
            $this->clickUpdateService($browser, $service)
                ->assertInputValue('name', $service->name);
        });
    }

    /**
     * Test admin update service success.
     *
     * @return void
     */
    public function testUpdatesServiceSuccess()
    {
        $this->browse(function (Browser $browser) {
            $service = Service::find(1);
            $page = $this->clickUpdateService($browser, $service);
            $page->type('name', 'Massage sauna')
                ->press('Submit')
                ->assertPathIs('/admin/service')
                ->assertSee('Update success');
            $serviceName = Service::find(1)->name;
            $this->assertTrue($serviceName == 'Massage sauna');

            $serviceNameElm = $page->text('#table-contain tbody tr:nth-child(1) td:nth-child(2)');
            $this->assertTrue($serviceNameElm == 'Massage sauna');
            $this->assertDatabaseHas('services', [
                'name' => 'Massage sauna',
            ]);
        });
        
    }

    /**
     * List case for test validation update service
     *
     */
    public function listCaseTestForUpdateService()
    {   
        return [
            ['', 'The name field is required.'],
            ['Wifi', 'The name has already been taken.']
        ];
    }

    /**
     * Test update place fail
     *
     * @dataProvider listCaseTestForUpdateService
     * 
     * @param string $name place name
     * @param string $descript place descript
     * @param string $image place image
     * @param string $expected message warning
     * 
     */ 
    public function testUpdatePlaceFail($name, $expected)
    {   
        
        $this->browse(function (Browser $browser) use ($name, $expected) {
            $service = Service::find(1);
            $this->clickUpdateService($browser, $service)
                ->type('name', $name)
                ->press('Submit')
                ->assertSee($expected)
                ->assertPathIs('/admin/place/' . $place->id . '/edit');
        });
    }

    // /**
    //  * Test 404 Page Not found when click edit service from list service.
    //  *
    //  * @return void
    //  */
    // public function test404PageForClickEdit()
    // {   
    //     $place = Place::find(1);
    //     $this->browse(function (Browser $browser) use ($place) {
    //         $browser->visit('/admin/place')->assertSee('List place');
    //         $place->delete();
    //         $browser->press('#table-contain tbody tr:nth-child(1) td:nth-child(5) a');
    //         $browser->assertSee('404 - Page Not found');
    //     });
    // }

    // /**
    //  * Test 404 Page Not found when click submit edit place.
    //  *
    //  * @return void
    //  */
    // public function test404PageForClickSubmit()
    // {   
    //     $place = Place::find(1);
    //     $this->browse(function (Browser $browser) use ($place) {
    //         $browser->visit('/admin/place')
    //             ->assertSee('List place')
    //             ->press('#table-contain tbody tr:nth-child(1) td:nth-child(5) a')
    //             ->assertPathIs('/admin/place/'.$place->id.'/edit')
    //             ->assertSee('Update place')
    //             ->type('name', 'Ha Long')
    //             ->type('descript', 'Quang Ninh');
    //         $place->delete();
    //         $browser->press('Submit')->assertSee('404 - Page Not found');
                    
    //     });
    // }
}
