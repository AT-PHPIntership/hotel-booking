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
    public function testLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('Login')
                    ->assertSee('Login')
                    ->assertPathIs('/login');
        });
    }

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
     * Test Login success if account admin.
     *
     * @return void
     */
    public function testAdminLoginSuccess()
    {   
        $this->makeData();
        $this->browse(function (Browser $browser)  {
            $browser->visit('/')
                    ->clickLink('Login')
                    ->assertSee('Login')
                    ->assertPathIs('/login')
                    ->type('username', 'admin')
                    ->type('password', 'admin') 
                    ->press('LOGIN')
                    ->assertSee('Home Page')
                    ->assertPathIs('/admin');
        });
    }

    /**
     * Test Login success if account user.
     *
     * @return void
     */
    public function testUserLoginSuccess()
    {   
        $this->makeData();
        $this->browse(function (Browser $browser)  {
            $browser->logout();
            $user = User::find(2);
            $browser->visit('/')
                    ->clickLink('Login')
                    ->assertSee('Login')
                    ->assertPathIs('/login')
                    ->type('username', 'user1')
                    ->type('password', 'user1')
                    ->press('LOGIN')
                    ->assertSee('Outstanding Places')
                    ->assertSee($user->username)
                    ->assertPathIs('/');
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
            ['hello', 'password', 'The selected username is invalid.'],
            ['user2', 'user2', 'The selected username is invalid.'],
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
                ->type('username', $username)
                ->type('password', $password)
                ->press('LOGIN')
                ->assertSee($expected)
                ->assertPathIs('/login');
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
