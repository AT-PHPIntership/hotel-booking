<?php

namespace Tests\Browser\Pages\Backend\Categories;

use App\Model\Category;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class AdminUpdateCategoryTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        Category::create([
            'name' => 'News World',
         ]);
    }

    /**
     * Test value for each input in edit form.
     *
     * @return void
     */
    public function testValueEditCategory()
    {
        $this->browse(function (Browser $browser)  {
            $category = Category::find(1);
            $page = $browser->visit('/admin/category')
                ->press('#table-contain tbody tr:nth-child(1) td:nth-child(3) a');
            $page->assertPathIs('/admin/category/' . $category->id . '/edit')
                ->assertSee('Update Category')
                ->assertInputValue('name', $category->name);
        });
    }

    /**
     * Test admin update category success.
     *
     * @return void
     */
    public function testUpdateCategorySuccess()
    {
        $this->browse(function (Browser $browser) {
            $category = Category::find(1);
            $page = $browser->visit('/admin/category')
                ->press('#table-contain tbody tr:nth-child(1) td:nth-child(3) a');
            $page->assertPathIs('/admin/category/' . $category->id . '/edit')
                ->assertSee('Update Category')
                ->type('name', 'Sport')
                ->press('Submit')
                ->assertPathIs('/admin/category')
                ->assertSee('Update Success');

            $category_after_update = Category::find(1);
            $this->assertTrue($category->name != $category_after_update->name );
            $this->assertDatabaseHas('categories', [
                'name' => 'Sport',
            ]);
        });
        
    }

    /**
     * Test update category fail
     *
     */
    public function testUpdateCategoryFail()
    {   
        
        $this->browse(function (Browser $browser) {
            $category = Category::find(1);
            $browser->visit('/admin/category')
                ->press('#table-contain tbody tr:nth-child(1) td:nth-child(3) a')
                ->assertPathIs('/admin/category/' . $category->id . '/edit')
                ->assertSee('Update Category')
                ->type('name', '')
                ->press('Submit')
                ->assertSee('The name field is required.')
                ->assertPathIs('/admin/category/' . $category->id . '/edit');
        });
    }

    /**
     * Test 404 Page Not found when click edit category from list category.
     *
     * @return void
     */
    public function test404PageForClickEdit()
    {   
        $category = Category::find(1);
        $this->browse(function (Browser $browser) use ($category) {
            $browser->visit('/admin/category')->assertSee('List Categories');
            $category->delete();
            $browser->press('#table-contain tbody tr:nth-child(1) td:nth-child(3) a');
            $browser->assertSee('404 - Page Not found');
        });
    }

    /**
     * Test 404 Page Not found when click submit edit category.
     *
     * @return void
     */
    public function test404PageForClickSubmit()
    {   
        $category = Category::find(1);
        $this->browse(function (Browser $browser) use ($category) {
            $browser->visit('/admin/category')
                ->assertSee('List Categories')
                ->press('#table-contain tbody tr:nth-child(1) td:nth-child(3) a')
                ->assertPathIs('/admin/category/'.$category->id.'/edit')
                ->assertSee('Update Category')
                ->type('name', 'News Hot ');
            $category->delete();
            $browser->press('Submit')->assertSee('404 - Page Not found');
        });
    }
}
