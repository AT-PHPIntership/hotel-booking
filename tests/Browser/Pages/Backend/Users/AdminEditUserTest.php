<?php

namespace Tests\Browser\Pages\Backend\Users;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\User;

class AdminEditUserTest extends DuskTestCase
{
        use DatabaseMigrations;
    /**
     * Test Route View Admin Edit User Page.
     *
     * @return void
     */
    public function testEditUser()
    {
        factory(User::class, 4)->create();
        $user = User::find(4);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/admin/user')
                    ->press('#table-contain tbody tr:nth-child(2) td:nth-child(8) a')
                    ->assertPathIs('/admin/user/'.$user->id.'/edit')
                    ->assertSee('Update user');
        });
    }

    /**
     * Test Value For Each Input In Edit Page.
     *
     * @return void
     */
    public function testValueEditUser()
    {
        factory(User::class, 4)->create();
        $user = User::find(4);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/admin/user')
                    ->press('#table-contain tbody tr:nth-child(2) td:nth-child(8) a')
                    ->assertPathIs('/admin/user/'.$user->id.'/edit')
                    ->assertSee('Update user')
                    ->assertInputValue('username', $user->username)
                    ->assertInputValue('password', null)
                    ->assertInputValue('full_name', $user->full_name)
                    ->assertInputValue('email', $user->email)
                    ->assertInputValue('phone', $user->phone);
            if ($user->is_admin == 1) {
                $browser->assertChecked('is_admin');
            } else {
                $browser->assertNotChecked('is_admin');
            }
            if ($user->is_active == 1) {
                $browser->assertChecked('is_active');
            } else {
                $browser->assertNotChecked('is_active');
            }
        });
    }

    /**
     * Test Admin Update User success.
     *
     * @return void
     */
    public function testUpdatesUserSuccess()
    {
        factory(User::class, 4)->create();
        $user = User::find(4);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/admin/user')
                    ->press('#table-contain tbody tr:nth-child(2) td:nth-child(8) a')
                    ->assertPathIs('/admin/user/'.$user->id.'/edit')
                    ->assertSee('Update user')
                    ->type('password','123')
                    ->type('full_name','HTYen')
                    ->type('phone','12345678')
                    ->check('is_admin')
                    ->press('Submit')
                    ->assertPathIs('/admin/user')
                    ->assertSee('Update successful!');
        });
        $this->assertDatabaseHas('users', ['full_name' => 'HTYen']);
    }
    
    public function listCaseTestValidationForUpdateUser()
    {
        return [
            ['1', 'HTYen', '12345678', 'The password must be at least 3 characters.'],
            ['', '', '12345678', 'The full name field is required.'],
            ['', 'HTYen', '', 'The phone field is required.'],
            ['', 'HTYen', '12fff', 'The phone must be a number.'],
        ];
    }
    /**
     * @dataProvider listCaseTestValidationForUpdateUser
     *
     */
    public function testUpdateUserFailValidation(
        $password,
        $full_name,
        $phone,
        $expected
    ) {
        factory(User::class, 4)->create();
        $user = User::find(4);
        
        $this->browse(function (Browser $browser) use(
            $password,
            $full_name,
            $phone,
            $expected,
            $user
        ) {
            
            $browser->visit('/admin/user')
                ->press('#table-contain tbody tr:nth-child(2) td:nth-child(8) a')
                ->assertPathIs('/admin/user/'.$user->id.'/edit')
                ->type('password', $password)
                ->type('full_name', $full_name)
                ->type('phone', $phone)
                ->press('Submit')
                ->assertSee($expected)
                ->assertPathIs('/admin/user/'.$user->id.'/edit');
        });
    }
    /**
     * Test Button Reset
     *
     * @return void
     */
    public function testBtnReset()
    {
        factory(User::class, 4)->create();
        $user = User::find(4);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/admin/user')
                    ->press('#table-contain tbody tr:nth-child(2) td:nth-child(8) a')
                    ->assertPathIs('/admin/user/'.$user->id.'/edit')
                    ->assertSee('Update user')
                    ->type('password','123')
                    ->type('full_name','HTYen')
                    ->type('phone','12345678')
                    ->check('is_admin')
                    ->press('Reset')
                    ->assertInputValue('password', null)
                    ->assertInputValue('full_name', $user->full_name)
                    ->assertInputValue('phone', $user->phone);
            if ($user->is_admin == 1) {
                $browser->assertChecked('is_admin');
            } else {
                $browser->assertNotChecked('is_admin');
            }
            if ($user->is_active == 1) {
                $browser->assertChecked('is_active');
            } else {
                $browser->assertNotChecked('is_active');
            }
        });
    }

    /**
     * Test 404 Page Not found when click edit user.
     *
     * @return void
     */
    public function test404PageForClickEdit()
    {   
        factory(User::class, 4)->create();
        $user = User::find(4);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/admin/user')
                    ->assertSee('List User');
            $user->delete();
            $browser->press('#table-contain tbody tr:nth-child(2) td:nth-child(8) a');
            $browser->assertSee('404 - Page Not found');
        });
    }

    /**
     * Test 404 Page Not found when click submit edit user.
     *
     * @return void
     */
    public function test404PageForClickSubmit()
    {   
        factory(User::class, 4)->create();
        $user = User::find(4);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/admin/user')
                    ->assertSee('List User')
                    ->press('#table-contain tbody tr:nth-child(2) td:nth-child(8) a')
                    ->assertPathIs('/admin/user/'.$user->id.'/edit')
                    ->assertSee('Update user')
                    ->type('password','123')
                    ->type('full_name','HTYen')
                    ->type('phone','12345678')
                    ->check('is_admin');
            $user->delete();
            $browser->press('Submit')
                    ->assertSee('404 - Page Not found');
        });
    }
}
