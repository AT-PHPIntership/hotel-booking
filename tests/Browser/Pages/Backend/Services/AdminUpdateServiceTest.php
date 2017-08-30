<?php

namespace Tests\Browser\Pages\Backend\Services;

use App\Model\Service;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class AdminUpdateServiceTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        Service::create([
            'name' => 'Massage',
        ]);
        
    }

    public function clickLinkUpdateService($browser, $service)
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
            $this->clickLinkUpdateService($browser, $service)
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
            $page = $this->clickLinkUpdateService($browser, $service);
            $page->type('name', 'Massage sauna')
                ->press('Submit')
                ->assertPathIs('/admin/service')
                ->assertSee('Update success');

            $serviceNameElm = $page->text('#table-contain tbody tr:nth-child(1) td:nth-child(2)');
            $this->assertTrue($serviceNameElm == 'Massage sauna');

            $this->assertDatabaseHas('services', [
                'id' => '1',
                'name' => 'Massage sauna',
            ]);
        });
        
    }

    /**
     * Test validation update service
     */ 
    public function testValidationUpdateService()
    {   
        $this->browse(function (Browser $browser) {
            $service = Service::find(1);
            $this->clickLinkUpdateService($browser, $service)
                ->type('name', '')
                ->press('Submit')
                ->assertSee('The name field is required.')
                ->assertPathIs('/admin/service/' . $service->id . '/edit');
        });
    }

    /**
     * Test 404 Page Not found when click edit service from list service.
     *
     * @return void
     */
    public function test404PageForClickEdit()
    {   
        $service = Service::find(1);
        $this->browse(function (Browser $browser) use ($service) {
            $browser->visit('/admin/service')->assertSee('List service');
            $service->delete();
            $browser->press('#table-contain tbody tr:nth-child(1) td:nth-child(3) a');
            $browser->assertSee('404 - Page Not found');
        });
    }

    /**
     * Test 404 Page Not found when click submit edit service.
     *
     * @return void
     */
    public function test404PageForClickSubmit()
    {
        $service = Service::find(1);
        $this->browse(function (Browser $browser) use ($service) {
            $this->clickLinkUpdateService($browser, $service)
                ->type('name', 'Breakfast');
            $service->delete();
            $browser->press('Submit')->assertSee('404 - Page Not found');
        });
    }
}
