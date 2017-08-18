<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Model\Category;

class AdminDeleteCategory extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test Delete succeed.
     *
     * @return void
     */
    public function testDeleteSuccess()
    {
        factory(Category::class, 10)->create();
        $this->browse(function (Browser $browser) {
            $element = $browser->visit('/admin/category')->elements('#table-contain tbody tr');
            echo count($element);
            $this->assertCount(10, $element);
            $browser->assertSee('List Categories')
                    ->press('#table-contain tbody tr:nth-child(1) td:nth-child(3) button')
                    ->waitForText('Confirm deletion!')
                    ->press('Delete')
                    ->assertSee('Delete Success');
                    

            $this->assertSoftDeleted('categories', ['id'=>'10']);
            $element = $browser->visit('/admin/category')->elements('#table-contain tbody tr');
            $this->assertCount(9, $element);
        });
    }

    /**
     * A Dusk test Delete succeed.
     *
     * @return void
     */
    public function testDeleteNotFound()
    {
        factory(Category::class, 10)->create();
        $this->browse(function (Browser $browser) {
            $element = $browser->visit('/admin/category')->elements('#table-contain tbody tr');
            $category = Category::find(10);
            $this->assertCount(10, $element);
            $browser->assertSee('List Categories')
                    ->press('#table-contain tbody tr:nth-child(1) td:nth-child(3) button');
            $category->delete();
            $browser->waitFOr(null, '1')
                    ->waitForText('Confirm deletion!')
                    ->press('Delete')
                    ->assertSee('404 - Page Not found');
        });
    }

}

