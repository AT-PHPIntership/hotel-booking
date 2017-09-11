<?php

namespace Tests\Browser\Pages\Frontend\Register;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\User;

class RegisterTest extends DuskTestCase
{   
    use DatabaseMigrations;
    
    /**
     * Test route page register.
     *
     * @return void
     */
    public function testRegister()
    {
        $this->browse(function (Browser $browser) {
            $browser->logout();
            $browser->visit('/')
                    ->clickLink('Register')
                    ->assertSee('Register')
                    ->assertPathIs('/register')
                    ->assertMissing('#user-profile')
                    ->assertMissing('#logout')
                    ->assertVisible('#login')
                    ->assertVisible('#register');
        });
    }   

    /**
     * Test validation register.
     *
     * @return void
     */
    public function testValidationRegister()
    {
        $this->browse(function (Browser $browser) {
            $browser->logout();
            $browser->visit('/register')
                    ->press('SUBMIT')
                    ->assertSee('The full name field is required.')
                    ->assertSee('The username field is required.')
                    ->assertSee('The email field is required.')
                    ->assertSee('The phone field is required.')
                    ->assertSee('The password field is required.')
                    ->assertPathIs('/register');
        });
    }

    /**
     * Test Register success.
     *
     * @return void
     */
    public function testRegisterSuccess()
    {
        $this->browse(function (Browser $browser) {
            $browser->logout();
            $browser->visit('/')
                    ->assertVisible('#login')
                    ->assertVisible('#register')
                    ->clickLink('Register')
                    ->type('full_name', 'Duoc Nguyen C.')
                    ->type('username', 'duocduoc')
                    ->type('email','duoc.nguyen@gmail.com')
                    ->type('phone', '01206223029')
                    ->type('password', 'duoc123')
                    ->type('password_confirmation', 'duoc123')
                    ->press('SUBMIT')
                    ->assertPathIs('/registerSuccess')
                    ->pause('5000')
                    ->assertMissing('#login')
                    ->assertMissing('#register')
                    ->assertSee('duocduoc')
                    ->assertSee('Outstanding Places')
                    ->assertPathIs('/');           
        });
    }

    /**
     *  List case for Test Validation Register.
     *
     * @return array
     */
    public function listCaseTestValidationForRegister()
    {
        return [
            ['', 'user1', 'user1@gmail.com', '01206223029' ,'password', 'password', 'The full name field is required.'],
            ['Duoc', '', 'user1@gmail.com', '01206223029' ,'password', 'password', 'The username field is required.'],
            ['Duoc', 'user1', '', '01206223029' ,'password', 'password', 'The email field is required.'],
            ['Duoc', 'user1', 'email.user1', '01206223029' ,'password', 'password', 'The email must be a valid email address.'],
            ['Duoc', 'user1', 'user1@gmail.com', '' ,'password', 'password', 'The phone field is required.'],
            ['Duoc', 'user1', 'user1@gmail.com', 'hello' ,'password', 'password', 'The phone must be a number.'],
            ['Duoc', 'user1', 'user1@gmail.com', '01206223029' ,'', 'password', 'The password field is required.'],
            ['Duoc', 'user1', 'user1@gmail.com', '01206223029' ,'password', 'passsss', 'The password confirmation does not match.'],
            ['Duoc', 'user1', 'user1@gmail.com', '01206223029' ,'pass', 'pass', 'The password must be at least 6 characters.'],
            ['Duoc', 'duocduoc', 'user1@gmail.com', '01206223029' ,'password', 'password', 'The username has already been taken.'],
            ['Duoc', 'user1', 'duoc.nguyen@gmail.com', '01206223029' ,'password', 'password', 'The email has already been taken.'],
        ];
    }

    /**
     *
     * @dataProvider listCaseTestValidationForRegister
     *
     */
    public function testRegisterFail($name, $username, $email, $phone, $password, $confirm_password, $expected)
    {   
        $this->makeData();
        $this->browse(function (Browser $browser) use ($name, $username, $email, $phone, $password, $confirm_password, $expected) {
            $browser->logout();
            $browser->visit('/register')
                ->type('full_name', $name)
                ->type('username', $username)
                ->type('email', $email)
                ->type('phone', $phone)
                ->type('password', $password)
                ->type('password_confirmation', $confirm_password)
                ->press('SUBMIT')
                ->assertSee($expected)
                ->assertPathIs('/register')
                ->assertVisible('#login')
                ->assertVisible('#register');
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
            'username' => 'duocduoc',
            'password' => bcrypt('duoc123'),
            'is_active' => 1,
            'is_admin' => 0,
            'full_name' => 'Duoc Nguyen C.',
            'email' => 'duoc.nguyen@gmail.com'
            ]);
    }
}
