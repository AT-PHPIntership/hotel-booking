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
            $browser->visit('/')
                    ->clickLink('Login')
                    ->type('username', 'user1')
                    ->type('password', 'user1')
                    ->press('LOGIN')
                    ->mouseover('#navbar-collapse-grid ul li:nth-child(4)')
                    ->clickLink('Profile')
                    ->assertSee('User Profile')
                    ->assertPathIs('/user/'.$user->id);
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
            $browser->visit('/')
                    ->clickLink('Login')
                    ->type('username', 'user1')
                    ->type('password', 'user1')
                    ->press('LOGIN')
                    ->mouseover('#navbar-collapse-grid ul li:nth-child(4)')
                    ->clickLink('Profile')
                    ->assertSee('User Profile')
                    ->assertPathIs('/user/'.$user->id)
                    ->assertMissing('#table-comment')
                    ->assertMissing('#table-reservation');
            $this->assertTrue($browser->text('.table-user-information tbody tr:nth-child(1) td:nth-child(2)') === $user->full_name);
            $this->assertTrue($browser->text('.table-user-information tbody tr:nth-child(2) td:nth-child(2)') === $user->phone);
            $this->assertTrue($browser->text('.table-user-information tbody tr:nth-child(3) td:nth-child(2)') === $user->email);
            $this->assertTrue($browser->text('.table-user-information tbody tr:nth-child(4) td:nth-child(2)') === $user->role);
            $this->assertTrue($browser->text('.table-user-information tbody tr:nth-child(5) td:nth-child(2)') === (string)$user->reservations->count());
            $this->assertTrue($browser->text('.table-user-information tbody tr:nth-child(6) td:nth-child(2)') === (string)$user->ratingComments->count());
            $this->assertTrue($browser->text('.panel-title') === $user->username);
            $browser->click('.table-user-information tbody tr:nth-child(5) td:nth-child(2) a')
                    ->assertVisible('#table-reservation')
                    ->assertSee('List Reservations')
                    ->click('.table-user-information tbody tr:nth-child(6) td:nth-child(2) a')
                    ->assertVisible('#table-comment')
                    ->assertSee('List comment & rating')
                    ->assertPathIs('/user/'.$user->id);
        });
    }

    public function testBtnBack()
    {   
        $this->makeData();
        $this->browse(function (Browser $browser) {
            $browser->logout();
            $user = User::find(2);
            $browser->visit('/')
                    ->clickLink('Login')
                    ->type('username', 'user1')
                    ->type('password', 'user1')
                    ->press('LOGIN')
                    ->mouseover('#navbar-collapse-grid ul li:nth-child(4)')
                    ->clickLink('Profile')
                    ->assertSee('User Profile')
                    ->assertPathIs('/user/'.$user->id)
                    ->clickLink('Back')
                    ->assertSee('Outstanding Places')
                    ->assertPathIs('/');
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
