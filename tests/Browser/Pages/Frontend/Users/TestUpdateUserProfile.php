<?php

namespace Tests\Browser\Pages\Frontend\Users;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\User;
use App\Model\Image;
use Illuminate\Http\UploadedFile;

class TestUpdateUserProfile extends DuskTestCase
{   
    use DatabaseMigrations;

    /**
     * Test route page update user profile.
     *
     * @return void
     */
    public function testUpdateUserProfile()
    {   
        $this->makeData();
        $this->browse(function (Browser $browser) {
            $browser->logout();
            $user = User::find(2);
            $browser->loginAs($user)
                    ->visit('/profile/'.$user->id)
                    ->click('.fa-edit')
                    ->assertSee('Update Profile')
                    ->assertPathIs('/profile/' .$user->id. '/edit');
        });
    }

    /**
     * Test each value for form update user profile.
     *
     * @return void
     */
    public function testValueFormUserProfile()
    {   
        $this->makeData();
        $this->browse(function (Browser $browser) {
            $browser->logout();
            $user = User::find(2);
            $browser->loginAs($user)
                    ->visit('/profile/'.$user->id. '/edit')
                    ->assertInputValue('full_name', $user->full_name)
                    ->assertInputValue('email', $user->email)
                    ->assertInputValue('phone', $user->phone)
                    ->assertInputValue('password', '')
                    ->assertPathIs('/profile/'.$user->id.'/edit');
        });
    }

    /**
     * Test update user profile success.
     *
     * @return void
     */
    public function testUpdateUserProfileSuccess()
    {   
        $this->makeData();
        $this->browse(function (Browser $browser) {
            $browser->logout();
            $user = User::find(2);
            $browser->loginAs($user)
                    ->visit('/profile/'.$user->id. '/edit')
                    ->type('full_name', 'Duoc Nguyen')
                    ->type('email', 'duocnguyen@example.com')
                    ->type('phone', '01206223029')
                    ->press('SUBMIT')
                    ->assertSee('Update Profile Success!');
            $browser->assertSeeIn('.table-user-information tbody tr:nth-child(1) td:nth-child(2)', 'Duoc Nguyen')
                    ->assertSeeIn('.table-user-information tbody tr:nth-child(2) td:nth-child(2)', '01206223029')
                    ->assertSeeIn('.table-user-information tbody tr:nth-child(3) td:nth-child(2)', 'duocnguyen@example.com')
                    ->assertPathIs('/profile/'.$user->id);
        });
    }

    /**
     * Test update user profile if no change password.
     *
     * @return void
     */
    public function testNoChangePassword()
    {   
        $this->makeData();
        $this->browse(function (Browser $browser) {
            $browser->logout();
            $user = User::find(2);
            $browser->loginAs($user)
                    ->visit('/profile/'.$user->id. '/edit')
                    ->press('SUBMIT')
                    ->assertSee('Update Profile Success!');
            $browser->assertSeeIn('.table-user-information tbody tr:nth-child(1) td:nth-child(2)', $user->full_name)
                    ->assertSeeIn('.table-user-information tbody tr:nth-child(2) td:nth-child(2)', $user->phone)
                    ->assertSeeIn('.table-user-information tbody tr:nth-child(3) td:nth-child(2)', $user->email)
                    ->assertPathIs('/profile/'.$user->id);
            $browser->logout()
                    ->visit('/login')
                    ->type('username', 'user1')
                    ->type('password', 'user1')
                    ->press('LOGIN')
                    ->assertSee($user->username)
                    ->assertPathIs('/');
        });
    }

    /**
     * Test update user profile if change password.
     *
     * @return void
     */
    public function testChangePassword()
    {   
        $this->makeData();
        $this->browse(function (Browser $browser) {
            $browser->logout();
            $user = User::find(2);
            $browser->loginAs($user)
                    ->visit('/profile/'.$user->id. '/edit')
                    ->type('password', 'userpassword')
                    ->press('SUBMIT')
                    ->assertSee('Update Profile Success!');
            $browser->assertSeeIn('.table-user-information tbody tr:nth-child(1) td:nth-child(2)', $user->full_name)
                    ->assertSeeIn('.table-user-information tbody tr:nth-child(2) td:nth-child(2)', $user->phone)
                    ->assertSeeIn('.table-user-information tbody tr:nth-child(3) td:nth-child(2)', $user->email)
                    ->assertPathIs('/profile/'.$user->id);
            $browser->logout()
                    ->visit('/login')
                    ->type('username', 'user1')
                    ->type('password', 'userpassword')
                    ->press('LOGIN')
                    ->assertSee($user->username)
                    ->assertPathIs('/');
        });
    }

    /**
     * Test update user profile if change image.
     *
     * @return void
     */
    public function testChangeImage()
    {   
        $this->makeData();
        $this->browse(function (Browser $browser) {
            $browser->logout();
            $user = User::find(2);
            $browser->loginAs($user)
                    ->visit('/profile/'.$user->id. '/edit')
                    ->attach('image', $this->fakeImage())
                    ->press('SUBMIT')
                    ->assertSee('Update Profile Success!');
            $browser->assertSeeIn('.table-user-information tbody tr:nth-child(1) td:nth-child(2)', $user->full_name)
                    ->assertSeeIn('.table-user-information tbody tr:nth-child(2) td:nth-child(2)', $user->phone)
                    ->assertSeeIn('.table-user-information tbody tr:nth-child(3) td:nth-child(2)', $user->email)
                    ->assertPathIs('/profile/'.$user->id);
            $imageSrc = $browser->element('.img-circle')->getAttribute('src');
            $imageName = explode('/', $imageSrc);
            $this->assertTrue($imageName[5] ===  $user->images[0]->path);
        });
    }

    /**
     * Test update user profile if no change image.
     *
     * @return void
     */
    public function testNoChangeImage()
    {   
        $this->makeData();
        $this->browse(function (Browser $browser) {
            $browser->logout();
            $user = User::find(2);
            $browser->loginAs($user)
                    ->visit('/profile/'.$user->id. '/edit')
                    ->press('SUBMIT')
                    ->assertSee('Update Profile Success!');
            $browser->assertSeeIn('.table-user-information tbody tr:nth-child(1) td:nth-child(2)', $user->full_name)
                    ->assertSeeIn('.table-user-information tbody tr:nth-child(2) td:nth-child(2)', $user->phone)
                    ->assertSeeIn('.table-user-information tbody tr:nth-child(3) td:nth-child(2)', $user->email)
                    ->assertPathIs('/profile/'.$user->id);
            $imageSrc = $browser->element('.img-circle')->getAttribute('src');
            $imageName = explode('/', $imageSrc);
            if (isset($user->images[0])) {
                $this->assertTrue($imageName[5] ===  $user->images[0]);
            } else {
                $this->assertTrue($imageName[5] ===  'profile.png');
            }
            
        });
    }

    /**
     * Cases of test update profile fail
     *
     * @return array
     */
    public function listCaseTestUpdateProfile()
    {   
        return [
            [' ', '01206223029','email1@gmail.com', '', 'The full name field is required.'],
            ['Duoc Nguyen', '', 'email1@gmail.com', '', 'The phone field is required.'],
            ['Duoc Nguyen', '01206223029', '', '', 'The email field is required.'],
            ['Duoc Nguyen', 'asdsadsad', 'email1@gmail.com', '', 'The phone must be a number.'],
            ['Duoc Nguyen', '01206223029', 'user2@gmail.com','', 'The email has already been taken.'],
            ['Duoc Nguyen', '01206223029', 'email1@gmail.com', 'a', 'The password must be at least 3 characters.'],
        ];
    }

    /**
     * Test update profile fail.
     *
     * @dataProvider listCaseTestUpdateProfile
     *
     * @return void
     */
    public function testUpdatesProfileFail($name, $phone, $email, $password, $expect)
    {
        $this->makeData();
        $this->browse(function (Browser $browser) use ($name, $phone, $email, $password, $expect){
            $browser->logout();
            $user = User::find(2);
            $browser->loginAs($user)
                    ->visit('/profile/'.$user->id. '/edit')
                    ->type('full_name', $name)
                    ->type('phone', $phone)
                    ->type('email', $email)
                    ->type('password', $password)
                    ->press('SUBMIT')
                    ->assertSee($expect)
                    ->assertPathIs('/profile/'.$user->id. '/edit');
        });
        
    }

    /**
     * Fake image place
     * 
     * @return string
     */
    public static function fakeImage()
    {    
        $image = UploadedFile::fake()->image('avatar_test.jpg');
        return $image;
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
        factory(User::create([
            'username' => 'user2',
            'password' => bcrypt('user2'),
            'email' => 'user2@gmail.com',
            'full_name' => 'User2',
            'phone' => '0123456789',
            'is_active' => 1,
            'is_admin' => 0
            ])
        );
    }
}
