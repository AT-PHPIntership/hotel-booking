<?php

namespace Tests\Browser\Pages\Backend\Users;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\User;

class AdminSearchUserTest extends DuskTestCase
{
   use DatabaseMigrations;

    /**
     *Test search if not input value.
     *
     * @return void
     */
    public function testSearchNotInputValue()
    {
        $this->makeData(9);        
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/user')
                    ->press('.btn-search')
                    ->assertPathIs('/admin/user');
            $elements = $browser->elements('#table-contain tbody tr');
            $browser->press('.btn-search');
            $this->assertCount(10, $elements);  
        });
    }

    /**
     *Test search if has input value and not paginate.
     *
     * @return void
     */
    public function testSearchHasInputValue()
    {
 
        $this->makeData(9);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/user')
                    ->type('search', 'username2')
                    ->press('.btn-search')
                    ->assertPathIs('/admin/user')
                    ->assertQueryStringHas('search', 'username2');
            $elements = $browser->elements('#table-contain tbody tr');
            $this->assertCount(1, $elements);
            $this->assertNull($browser->element('.pagination'));
        });
    }

     /**
     *Test search if has input value return and paginate.
     *
     * @return void
     */
    public function testSearchHasInputValuePaginate()
    {
 
        $this->makeData(19);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/user')
                    ->type('search', 'username1')
                    ->press('.btn-search')
                    ->assertPathIs('/admin/user')
                    ->assertQueryStringHas('search', 'username1');
            $elements = $browser->elements('#table-contain tbody tr');
            $this->assertCount(10, $elements);
            $this->assertNotNull($browser->element('.pagination'));
        });
    }


    /**
     *Test search has input value but not found.
     *
     * @return void
     */
    public function testSearchNotResult()
    {
        $this->makeData(9);
        $this->browse(function (Browser $browser) {
            
            $browser->visit('/admin/user')
                    ->type('search', 'username11')
                    ->press('.btn-search')
                    ->assertPathIs('/admin/user')
                    ->assertQueryStringHas('search', 'username11');
            $elements = $browser->elements('#table-contain tbody tr');
            $numAccounts = count($elements);
            $this->assertCount(0, $elements);
            $browser->assertSee('Data Not Found');
            $this->assertNull($browser->element('.pagination'));
        });
    }

    /**
     * Make data of user
     */
    public function makeData($row)
    {
        for ($i=1; $i <= $row ; $i++) { 
            User::create([
                'username' => 'username'.$i,
                'full_name' => 'full_name'.$i,
                'email' => 'email'.$i.'@gmail.com',
                'phone' => '0000000'.$i
                ]);
        }
    }

}
