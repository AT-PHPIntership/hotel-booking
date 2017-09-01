<?php

namespace Tests\Browser\Pages\Backend\Login;

use Tests\DuskTestCaseLogin;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class AdminLoginTest extends DuskTestCaseLogin
{   
    use DatabaseMigrations;

    /**
     * Test route Login.
     *
     * @return void
     */
    // public function testLogin()
    // {
    //     $this->browse(function (Browser $browser) {
    //         $browser->visit('/')
    //                 ->clickLink('Login')
    //                 ->assertSee('Login')
    //                 ->assertPathIs('/login');
    //     });
    // }

    /**
     * Test Login success.
     *
     * @return void
     */
    public function testLoginSuccess()
    {   
        $this->makeData();
        $this->browse(function (Browser $browser)  {
            $user = User::find(1);
            $browser->visit('/')
                    ->clickLink('Login')
                    ->assertSee('Login')
                    ->assertPathIs('/login')
                    ->type('username', 'admin')
                    ->type('password', 'admin')
                    ->press('.btn-primary');
        });
    }

    /**
     * Make data for test.  
     *
     * @return void
     */
    public function makeData()
    {   
        factory(User::class, 1)->create([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'is_active' => 1,
            'is_admin' => 1,
            'full_name' => 'Admin'
            ]);
        factory(User::class, 1)->create([
            'username' => 'user1',
            'password' => bcrypt('user1'),
            'is_active' => 1,
            'is_admin' => 0,
            'full_name' => 'User1'
            ]);
    }
}
