<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminListNewsTest extends DuskTestCase
{   
    use DatabaseTransactions;
    
    /**
     * Test Admin List News.
     *
     * @return void
     */
    public function testAdminListNews()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news')
                    ->assertSee('List News of Hotel');
        });
    }

    /**
    * Test if DataBase has 0 Record in List View.
    *
    * @return void
    */
    public function testHasZeroRecordListNews()
    {   

        $this->browse(function (Browser $browser) {
        // If have 0 record
            $elements = $browser->visit('/admin/news')
                ->elements('#NewsTable tbody tr');
           $numAccounts = count($elements);
           $this->assertTrue($numAccounts == 0);
        });
    }

    /**
    * Test if DataBase has 10 Record in List View.
    *
    * @return void
    */
    public function  testHasTenRecordListNews()
    {   
        $this->browse(function (Browser $browser) {
           $elements = $browser->visit('/admin/news')
                ->elements('#NewsTable tbody tr');
           $numAccounts = count($elements);
           $this->assertTrue($numAccounts == 10);
        });
    }

     /**
    * Test if DataBase has  > 10 Record in List View.
    *
    * @return void
    */
    public function  testHasMoreRecordListNews()
    {   
        $this->browse(function (Browser $browser) {
           $elements = $browser->visit('/admin/news')
                ->elements('#NewsTable tbody tr');
           $numAccounts = count($elements);
           $this->assertTrue($numAccounts == 10);
           $elements = $browser->visit('/admin/news?page=2')
                ->elements('#NewsTable tbody tr');
           $numAccounts = count($elements);
           $this->assertTrue($numAccounts == 5);
        });
    }

}
