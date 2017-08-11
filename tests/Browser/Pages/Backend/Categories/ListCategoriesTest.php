<?php

namespace Tests\Browser\Pages\Backend\Categories;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
/*use Illuminate\Support\Facades\DB;*/

class ListCategoriesTest extends DuskTestCase
{

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testURL()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin')
                    ->clickLink('Categories')
                    ->assertPathIs('/admin/category')
                    ->assertTitle('Admin | Category')
                    ->assertSee('List Categories');
        });
    }
    
}
