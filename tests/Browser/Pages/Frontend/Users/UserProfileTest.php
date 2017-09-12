<?php

namespace Tests\Browser\Pages\Frontend\Users;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\User;

class UserProfileTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test route page user profile.
     *
     * @return void
     */
    public function testUserProfile()
    {   
        $this->makeData();
        $this->browse(function (Browser $browser) {
            $browser->logout();
            $user = User::find(2);
            $browser->loginAs($user)
                    ->visit('/')
                    ->mouseover('#navbar-collapse-grid ul li:nth-child(4)')
                    ->clickLink('Profile')
                    ->assertSee('User Profile')
                    ->assertPathIs('/profile/'.$user->id);
        });
    }

    /**
     * Test  show page user profile.
     *
     * @return void
     */
    public function testShowUserProfile()
    {   
        $this->makeData();
        $this->browse(function (Browser $browser) {
            $browser->logout();
            $user = User::find(2);
            $browser->loginAs($user)
                    ->visit('/')
                    ->mouseover('#navbar-collapse-grid ul li:nth-child(4)')
                    ->clickLink('Profile')
                    ->assertSee('User Profile')
                    ->assertPathIs('/profile/'.$user->id)
                    ->assertMissing('#table-comment')
                    ->assertMissing('#table-reservation');
            $browser->assertSeeIn('.table-user-information tbody tr:nth-child(1) td:nth-child(2)', $user->full_name)
                    ->assertSeeIn('.table-user-information tbody tr:nth-child(2) td:nth-child(2)', $user->phone)
                    ->assertSeeIn('.table-user-information tbody tr:nth-child(3) td:nth-child(2)', $user->email)
                    ->assertSeeIn('.table-user-information tbody tr:nth-child(4) td:nth-child(2)', $user->role)
                    ->assertSeeIn('.table-user-information tbody tr:nth-child(5) td:nth-child(2)', (string)$user->reservations->count())
                    ->assertSeeIn('.table-user-information tbody tr:nth-child(6) td:nth-child(2)', (string)$user->ratingComments->count())
                    ->assertSeeIn('.panel-title', $user->username);
        });
    }

    /**
     * Test show list history reservation of user.
     *
     * @return void
     */
    public function testShowListReservation()
    {
        $this->makeData();
        $this->browse(function (Browser $browser) {
            $browser->logout();
            $user = User::find(2);
            $browser->loginAs($user)
                    ->visit('/')
                    ->mouseover('#navbar-collapse-grid ul li:nth-child(4)')
                    ->clickLink('Profile')
                    ->click('.table-user-information tbody tr:nth-child(5) td:nth-child(2) a')
                    ->assertVisible('#table-reservation')
                    ->assertSee('List Reservations')
                    ->assertPathIs('/profile/'.$user->id);
        });
    }

    /**
     * Test show list history comment of user.
     *
     * @return void
     */
    public function testShowListComment()
    {
        $this->makeData();
        $this->browse(function (Browser $browser) {
            $browser->logout();
            $user = User::find(2);
            $browser->loginAs($user)
                    ->visit('/')
                    ->mouseover('#navbar-collapse-grid ul li:nth-child(4)')
                    ->clickLink('Profile')
                    ->click('.table-user-information tbody tr:nth-child(6) td:nth-child(2) a')
                    ->assertVisible('#table-comment')
                    ->assertSee('List comment & rating')
                    ->assertPathIs('/profile/'.$user->id);
        });
    }

    /**
     * Test  button Back.
     *
     * @return void
     */
    public function testBtnBack()
    {   
        $this->makeData();
        $this->browse(function (Browser $browser) {
            $browser->logout();
            $user = User::find(2);
            $browser->loginAs($user)
                    ->visit('/')
                    ->mouseover('#navbar-collapse-grid ul li:nth-child(4)')
                    ->clickLink('Profile')
                    ->assertSee('User Profile')
                    ->assertPathIs('/profile/'.$user->id)
                    ->clickLink('Back')
                    ->assertSee('Outstanding Places')
                    ->assertPathIs('/');
        });
    }

     /**
     * Test if user route page show profile of other user.
     *
     * @return void
     */
    public function testMiddleware()
    {   
        $this->makeData();
        $this->browse(function (Browser $browser) {
            $browser->logout();
            $user = User::find(2);
            $browser->loginAs($user)
                    ->visit('/')
                    ->mouseover('#navbar-collapse-grid ul li:nth-child(4)')
                    ->clickLink('Profile')
                    ->assertSee('User Profile')
                    ->assertPathIs('/profile/'.$user->id);
            $browser->visit('/profile/1')
                    ->assertSee('403 - Forbidden')
                    ->assertSee("Sorry...You don't have access to this request");
        });
    }
    /**
     * Make data for test
     *
     */
    public function makeData()
    {
        factory(User::create([
            'username' => 'user1',
            'password' => bcrypt('user1'),
            'email' => 'user1@gmail.com',
            'full_name' => 'User1',
            'phone' => '0123456789',
            'is_active' => 1,
            'is_admin' => 0
            ])
        );
    }
}
