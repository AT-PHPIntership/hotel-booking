<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminCreateNewsTest extends DuskTestCase
{
    // /**
    //  * Test View Admin Create News.
    //  *
    //  * @return void
    //  */
    // public function testCreatesNews()
    // {
    //     $this->browse(function (Browser $browser) {
    //         $browser->visit('/admin/news')
    //                 ->click('#btn-add-news')
    //                 ->assertPathIs('/admin/news/create')
    //                 ->screenShot(1);
    //     });
    // }

    /**
     * Test Validation Admin Create News.
     *
     * @return void
     */
    public function testValidationCreatesNews()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news/create')
                    // ->type('title','123')
                    // ->type('content','345')
                    // ->type('category_id','5')
                    ->screenShot('1')
                    ->press('Submit')
                    ->pause('1000')
                    ->screenShot(2)
                    ->waitForText('The title field is required.', 5)
                    ->screenShot(2)
                    ->assertSee('The content field is required.')
                    ->assertSee('The category id field is required.')
                    ;
        });
    }

}
