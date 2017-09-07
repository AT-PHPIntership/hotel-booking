<?php

namespace Tests\Browser\Pages\Backend\Users;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\User;

class AdminDeleteUserTest extends DuskTestCase
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
                ->assertSee('List Users');
        });
    }

    /**
     * Test success when click delete button.
     *
     * @return void
     */
    public function testDeleteSuccess()
    {
        factory(User::class, 4)->create();
        $this->browse(function (Browser $browser) {           
            $page = $browser->visit('/admin/user');
            $elements = $page->elements('#table-contain tbody tr');
            $this->assertCount(5, $elements);
            $page->press('#table-contain tbody tr:nth-child(2) td:nth-child(8) button')
                 ->waitFor(null, '1')
                 ->assertSee('Are you sure you want to delete?')
                 ->click('#delete-btn')
                 ->assertSee("Deletion successful!");
            $this->assertSoftDeleted('users', ['id' => '4']);    
            $elements = $page->elements('#table-contain tbody tr');    
            $this->assertCount(4, $elements);  
        });
    }

    /**
     * Test 404 Page Not found when delete user.
     *
     * @return void
     */
    public function test404Page()
    {   
        factory(User::class, 4)->create();
        $user = User::find(4);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/admin/user')
                    ->assertSee('List Users')
                    ->press('#table-contain tbody tr:nth-child(2) td:nth-child(8) button');
            $user->delete();
            $browser->waitFor(null, '1')
                    ->assertSee('Are you sure you want to delete?')
                    ->click('#delete-btn')
                    ->assertSee('404 - Page Not found');
        });
    }
}
