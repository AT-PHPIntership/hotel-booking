<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use App\Model\Category;

class AdminCreateCategory extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test route create category page.
     *
     * @return void
     */
    public function testCreateCategory()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/category')
                ->clickLink('Add Cagegory')
                ->assertPathIs('/admin/category/create')
                ->assertSee('Create Category');
        });
    }

    /**
     * Test Validation Admin Create Category.
     *
     * @return void
     */
    public function testValidationCreateCategory()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/category/create')
                ->press('Submit')
                ->assertPathIs('/admin/category/create')
                ->assertSee('The name field is required.');
        });
    }

    /**
     * Test Admin create Category success.
     *
     * @return void
     */
    public function testCreatesCategorySuccess()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/category/create')
                ->type('name','Category News')
                ->press('Submit')
                ->assertPathIs('/admin/category')
                ->assertSee('Create Success');
        });
        $this->assertDatabaseHas('categories', ['name' => 'Category News']);
    }

    /**
     *
     * Test Create category fail
     *
     */
    public function testCreateCategoryFail()
    {   
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/category/create')
                ->type('name', '')
                ->press('Submit')
                ->assertSee('The name field is required.')
                ->assertPathIs('/admin/category/create');
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
            $browser->visit('/admin/category/create')
                ->type('name', 'Category test')
                ->press('Reset')
                ->assertPathIs('/admin/category/create')
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
            $browser->visit('/admin/category/create')
                ->clickLink('Back')
                ->assertPathIs('/admin/category');
        });
    }
}
