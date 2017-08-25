<?php

namespace Tests\Browser\Pages\Backend\Services;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use App\Model\Service;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminCreateServiceTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function clickAddService($browser)
    {
        $page = $browser->visit('/admin/service')
            ->clickLink('Add service')
            ->assertPathIs('/admin/service/create')
            ->assertSee('Add service'); 

        return $page;
    }

    /**
     * Test validation admin create place.
     *
     * @return void
     */
    public function testValidation()
    {   
        $this->browse(function (Browser $browser) {
            $this->clickAddService($browser)
                ->press('Submit')
                ->assertPathIs('/admin/service/create')
                ->assertSee('The name field is required.');
        });
    }

    /**
     * Test Admin create place success.
     *
     * @return void
     */
    public function testCreateSuccess()
    {   
        $this->browse(function (Browser $browser) {
            $page = $this->clickAddService($browser);
            $page->type('name', 'Massage')
                ->press('Submit')
                ->assertPathIs('/admin/service')
                ->assertSee('Create success');
            $service = Service::find(1);
            $page->assertSee($service->name);
        });
        $this->assertDatabaseHas('services', ['name' => 'Massage']); 
    }

    /**
     * List case for test validation create service
     *
     */
    public function listCaseTestForCreateService()
    {   
        return [
            ['', 'The name field is required.'],
            ['Wifi', 'The name has already been taken.']
        ];
    }

    /**
     * Test create service fail
     *
     * @dataProvider listCaseTestForCreateService
     *
     */
     public function testCreateServiceFail($name, $expected)
    {   
        Service::create([
            'name' => 'Wifi',
        ]);
        $this->browse(function (Browser $browser) use ($name, $expected) {
            $this->clickAddService($browser)
                ->type('name', $name)
                ->press('Submit')
                ->assertSee($expected)
                ->assertPathIs('/admin/service/create');
        });
    }

    /**
     * Test Button Reset
     *
     * @return void
     */
    public function testBtnReset()
    {
        $this->browse(function (Browser $browser) {
            $this->clickAddService($browser)
                ->type('name', 'Wifi')
                ->press('Reset')
                ->assertPathIs('/admin/service/create')
                ->assertInputValue('name', '');
        });
    }

    /**
     * Test Button Back
     *
     * @return void
     */
    public function testBtnBack()
    {
        $this->browse(function (Browser $browser) {
            $this->clickAddService($browser)
                ->click('.box-footer .btn-default')
                ->assertPathIs('/admin/service');
        });
    }
}
