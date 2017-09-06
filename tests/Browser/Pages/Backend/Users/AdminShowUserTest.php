<?php

namespace Tests\Browser\Pages\Backend\Users;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\User;

class AdminShowUserTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test Value For Each Input In Show Page.
     *
     * @return void
     */
    public function testValueShowUser()
    {
        factory(User::class, 4)->create();
        $user = User::find(4);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/admin/user')
                    ->press('#table-contain tbody tr:nth-child(2) td:nth-child(2) a')
                    ->assertPathIs('/admin/user/'.$user->id)
                    ->assertSee('User Information')
                    ->assertInputValue('username', $user->username)
                    ->assertSee($user->full_name)
                    ->assertSee($user->email)
                    ->assertSee($user->phone);
            if ($user->is_admin == 1) {
                $browser->assertSee('Admin');
            } else {
                $browser->assertSee('User');
            }
            if ($user->is_active == 1) {
                $browser->assertSee('Actived');
            } else {
                $browser->assertSee('Disabled');
            }
        });
    }

    /**
     * Test Button Edit
     *
     * @return void
     */
    public function testBtnEdit()
    {
        factory(User::class, 4)->create();
        $user = User::find(4);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/admin/user')
                    ->press('#table-contain tbody tr:nth-child(2) td:nth-child(2) a')
                    ->assertPathIs('/admin/user/'.$user->id)
                    ->assertSee('User Information')
                    ->press('Edit')
                    ->assertPathIs('/admin/user/'.$user->id.'/edit')
                    ->assertSee('Update user');
        });
    }

    /**
     * Test Button Back
     *
     * @return void
     */
    public function testBtnBack()
    {
        factory(User::class, 4)->create();
        $user = User::find(4);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/admin/user')
                    ->press('#table-contain tbody tr:nth-child(2) td:nth-child(2) a')
                    ->assertPathIs('/admin/user/'.$user->id)
                    ->assertSee('User Information')
                    ->press('Back')
                    ->assertPathIs('/admin/user')
                    ->assertSee('List Users');
        });
    }

    /**
     * Test 404 Page Not found when click Show User.
     *
     * @return void
     */
    public function test404PageForClickShow()
    {   
        factory(User::class, 4)->create();
        $user = User::find(4);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/admin/user')
                    ->assertSee('List Users');
            $user->delete();
            $browser->press('#table-contain tbody tr:nth-child(2) td:nth-child(2) a');
            $browser->assertSee('404 - Page Not found');
        });
    }
}
