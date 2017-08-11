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
                    ->assertSee('ADD User');
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
                    ->assertSee('Creation successful!')
                    ->seeInDatabase('users', [
                        'username' => 'HTY'])
                    ->screenShot('success');
        });
    }
    
     /**
     * Test Admin create User fail.
     *
     * @return void
     */
    public function testCreatesUserFail()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/user/create')
                    ->type('username','HTY')
                    ->type('password','123')
                    ->type('password_confirmation','123')
                    ->type('full_name','HTYen')
                    ->type('email','hty@gmail.com')
                    ->type('phone','12345678000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000')
                    ->press('Submit')
                    ->assertPathIs('/admin/user')
                    ->assertSee('Creation successful!')
                    ->dontseeInDatabase('users', [
                        'username' => 'HTY'])
                    ->screenShot('fail');
        });
    }
    public function listCaseTestForCreateUser()
    {
        return [
            ['', 'Hello World!', '4', 'The title field is required.'],
            ['User55', '', '4', 'The content field is required.'],
            ['User55', 'Hello World!', '', 'The password_confirmation field is required.'],
        ];
    }
    /**
     * @dataProvider listCaseTestForCreateUser
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
            $browser->visit('/admin/User/create')
                    ->type('username','HTY')
                    ->type('password','123')
                    ->type('password_confirmation','123')
                    ->check('is_admin')
                    ->press('Reset')
                    ->assertPathIs('/admin/User/create')
                    ->assertDontSee('HTY')
                    ->assertDontSee('123');
            dd($browser->value('#username'));
        });
    }
}
}
