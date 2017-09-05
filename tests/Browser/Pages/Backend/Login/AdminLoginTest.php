<?php

namespace Tests\Browser\Pages\Backend\Login;

use Tests\DuskTestCaseLogin;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\User;

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
     * Test Validation Admin Create News.
     *
     * @return void
     */
    public function testValidationLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->press('LOGIN')
                    ->assertPathIs('/login')
                    ->assertSee('The username field is required.')
                    ->assertSee('The password field is required.');
        });
    }

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
                    ->press('LOGIN')
                    ->assertSee('Dashboard')
                    ->assertPathIs('/admin');
        });
    }

    /**
     * List case for Test Validation Login
     *
     */
    public function listCaseForTestLogin()
    {
        return [
            ['user1', '', 'The password field is required.'],
            ['', 'user1', 'The username field is required.'],
            ['user1', 'hello', 'These credentials do not match our records.'],
            ['hello', 'password', 'The selected username is invalid.'],

        ];
    }

    /**
     *
     * @dataProvider listCaseForTestLogin
     *
     */ 
    public function testCreateNewsFail($username, $password, $expected)
    {   
        
        $this->browse(function (Browser $browser) use ($username, $password, $expected)
        {
            $browser->visit('/login')
                ->type('username', $username);
                ->type('password', $password)
                ->press('LOGIN')
                ->assertSee($expected)
                ->assertPathIs('/login');
        });
    }

    /**
     * Test login if user is unactive.
     *
     * @return void
     */
    public function testLoginUserUnactive()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('username', 'user2')
                    ->type('password', 'user2')
                    ->press('LOGIN')
                    ->assertPathIs('/login')
                    ->assertSee('The selected username is invalid.');
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
        factory(User::class, 1)->create([
            'username' => 'user2',
            'password' => bcrypt('user2'),
            'is_active' => 0,
            'is_admin' => 0,
            'full_name' => 'User2'
            ]);
    }
}
