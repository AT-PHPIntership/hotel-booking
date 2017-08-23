<?php

namespace Tests\Browser\Pages\Backend\Users;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\User;

class AdminCreateUserTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test Route View Admin Create User.
     *
     * @return void
     */
    public function testCreatesUser()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/user')
                    ->click('#btn-add-user')
                    ->assertPathIs('/admin/user/create')
                    ->assertSee('Create user');
        });
    }

    /**
     * Test Validation Admin Create User.
     *
     * @return void
     */
    public function testValidationCreatesUser()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/user/create')
                    ->press('Submit')
                    ->assertPathIs('/admin/user/create')
                    ->assertSee('The username field is required.')
                    ->assertSee('The password field is required.')
                    ->assertSee('The password confirmation field is required.')
                    ->assertSee('The full name field is required.')
                    ->assertSee('The email field is required.')
                    ->assertSee('The phone field is required.');
        });
    }

    /**
     * Test Admin create User success.
     *
     * @return void
     */
    public function testCreatesUserSuccess()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/user/create')
                    ->type('username','HTY')
                    ->type('password','123')
                    ->type('password_confirmation','123')
                    ->type('full_name','HTYen')
                    ->type('email','hty@gmail.com')
                    ->type('phone','12345678')
                    ->check('is_admin')
                    ->press('Submit')
                    ->assertPathIs('/admin/user')
                    ->assertSee('Creation successful!');
        });
        $this->assertDatabaseHas('users', ['username' => 'HTY']);
    }
    
    public function listCaseTestValidationForCreateUser()
    {
        return [
            ['', '123', '123', 'HTYen' ,'hty@gmail.com', '12345678', 'The username field is required.'],
            ['HTY', '', '123', 'HTYen' ,'hty@gmail.com', '12345678', 'The password field is required.'],
            ['HTY', '123', '', 'HTYen' ,'hty@gmail.com', '12345678', 'The password confirmation field is required.'],
            ['HTY', '123', '123', '' ,'hty@gmail.com', '12345678', 'The full name field is required.'],
            ['HTY', '123', '123', 'HTYen' ,'', '12345678', 'The email field is required.'],
            ['HTY', '123', '123', 'HTYen' ,'hty@', '12345678', 'The email must be a valid email address.'],
            ['HTY', '123', '123', 'HTYen' ,'hty@gmail.com', '', 'The phone field is required.'],
            ['HTY', '123', '123', 'HTYen' ,'hty@gmail.com', '12fff', 'The phone must be a number.'],
        ];
    }

    /**
     * @dataProvider listCaseTestValidationForCreateUser
     *
     */
    public function testCreateUserFailValidation(
        $username,
        $password,
        $password_confirmation,
        $full_name,
        $email,
        $phone,
        $expected
    ) {   
        
        $this->browse(function (Browser $browser) use(
            $username,
            $password,
            $password_confirmation,
            $full_name,
            $email,
            $phone,
            $expected
        ) {
            
            $browser->visit('/admin/user/create')
                ->type('username', $username)
                ->type('password', $password)
                ->type('password_confirmation', $password_confirmation)
                ->type('full_name', $full_name)
                ->type('email', $email)
                ->type('phone', $phone)
                ->press('Submit')
                ->assertSee($expected)
                ->assertPathIs('/admin/user/create');
        });
    }
    /**
     * Test Button Reset
     *
     * @return void
     */
    public function testBtnReset()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/user/create')
                    ->type('username','HTY')
                    ->type('password','123')
                    ->type('password_confirmation','123')
                    ->check('is_admin')
                    ->press('Reset')
                    ->assertPathIs('/admin/user/create')
                    ->assertInputValueIsNot('username', 'HTY')
                    ->assertInputValueIsNot('password', '123')
                    ->assertNotChecked('is_admin');
        });
    }
}
