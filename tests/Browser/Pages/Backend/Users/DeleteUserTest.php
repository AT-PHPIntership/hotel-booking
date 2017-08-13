<?php

namespace Tests\Browser\Pages\Backend\Users;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\User;

class DeleteUserTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test route to user page.
     *
     * @return void
     */
    public function testVisitAdminUser()
   {
        $this->browse(function (Browser $browser) {
        $browser->visit('/admin')
                ->clickLink('Users')
                ->assertPathIs('/admin/user')
                ->assertTitleContains('User')
                ->assertSee('List User');
        });
    }

    /**
     * Test success when click delete button.
     *
     * @return void
     */
    public function testDeleteSuccess()
    {
        factory(User::class, 5)->create();
        $this->browse(function (Browser $browser) {           
            $page = $browser->visit('/admin/user');
            $elements = $page->elements('#table-contain tbody tr');
            $this->assertCount(5, $elements);
            $user = User::find(2);
            $page->press('#user_'.$user->id)
                 ->acceptDialog()
                 ->assertSee("Deletion successful!");
            $user = User::withTrashed()->find(2);
            $this->assertNotNull($user->deleted_at);    
            $elements = $page->elements('#table-contain tbody tr');    
            $this->assertCount(4, $elements);  
        });
    }

    /**
     * Test fail because object not exist.
     *
     * @return void
     */
    public function testDeleteObjectNotExist()
    {

    }

    /**
     * Test fail because can't delete.
     *
     * @return void
     */
    public function testCanNotDelete()
    {

    }
}
