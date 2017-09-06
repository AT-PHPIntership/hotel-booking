<?php

namespace Tests\Browser\Pages\Frontend\Users;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\User;

class UserProfileTest extends DuskTestCase
{
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
            $user = User::find(1);
            $browser->visit('/')
                    ->clickLink('Login')
                    ->type('username', 'user1')
                    ->type('password', 'user1')
                    ->press('LOGIN')
                    ->mouseover('#navbar-collapse-grid ul li:nth-child(4)')
                    ->clickLink('Profile')
                    ->screenShot('aaa');
                    // ->clickLink('Profile')
                    // ->assertSee('User Profile')
                    // ->assertPathIs('/user/'.$user->id);
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
