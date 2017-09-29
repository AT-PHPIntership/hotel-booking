<?php

namespace Tests\Browser\Pages\Frontend\Feedback;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use App\Model\Feedback;
use App\Model\User;

class FeedbackTest extends DuskTestCase
{   
    use DatabaseMigrations;

    /**
     * Test route page feedback.
     *
     * @return void
     */
    public function testFeedBack()
    {
        $this->browse(function (Browser $browser) {
            $browser->logout()
                    ->visit('/')
                    ->clickLink('Feedback')
                    ->assertSee('Feedback')
                    ->assertPathIs('/sendfeedback/create');
        });
    }

    /**
     * Test value of page feedback if guest visit page.
     *
     * @return void
     */
    public function testValuePageFeedBackIfNotLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->logout()
                    ->visit('/sendfeedback/create')
                    ->assertSee('Feedback')
                    ->assertInputValue('full_name', '')
                    ->assertInputValue('email', '')
                    ->assertInputValue('content', '')
                    ->assertPathIs('/sendfeedback/create');
        });
    }

    /**
     * Test value of page feedback if user visit page.
     *
     * @return void
     */
    public function testValuePageFeedBackIfLogin()
    {   
        $this->makeData();
        $this->browse(function (Browser $browser) {
            $user = User::find(2);
            $browser->loginAs($user)
                    ->visit('/sendfeedback/create')
                    ->assertSee('Feedback');
            $browser->assertInputValue('full_name', $user->full_name)
                    ->assertInputValue('email', $user->email)
                    ->assertInputValue('content', '')
                    ->assertPathIs('/sendfeedback/create');              
        });
    }

    /**
     * Test send feedback success of guest.
     *
     * @return void
     */
    public function testFeedBackSuccessIfNotLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->logout()
                    ->visit('/sendfeedback/create')
                    ->assertSee('Feedback')
                    ->type('full_name', 'Duoc Nguyen')
                    ->type('email', 'duocnguyen@example.com')
                    ->type('content', 'Very good. I like your website')
                    ->press('SUBMIT')
                    ->assertSee('Sent Feedback!')
                    ->assertPathIs('/sendfeedback/create');
            $this->assertDatabaseHas('feedbacks', [
                'full_name' => 'Duoc Nguyen',
                'email' => 'duocnguyen@example.com',
                'content' => 'Very good. I like your website'
            ]);
        });
    }

    /**
     * Test send feedback success if user login and don't change value of filed name, email.
     *
     * @return void
     */
    public function testFeedBackSuccessIfLoginAndNotChangeField()
    {
        $this->makeData();
        $this->browse(function (Browser $browser) {
            $user = User::find(2);
            $browser->loginAs($user)
                    ->visit('/sendfeedback/create')
                    ->assertSee('Feedback');
                $browser->type('content', 'Very good. I like your website')
                        ->press('SUBMIT')
                        ->assertSee('Sent Feedback!')
                        ->assertPathIs('/sendfeedback/create');   
                $this->assertDatabaseHas('feedbacks', [
                    'full_name' => $user->full_name,
                    'email' => $user->email,
                    'content' => 'Very good. I like your website'
                ]);
        });
    }

    /**
     * Test send feedback success if user login and change value of filed name, email.
     *
     * @return void
     */
    public function testFeedBackSuccessIfLoginAndChangeField()
    {   
        $this->makeData();
        $this->browse(function (Browser $browser) {
            $user = User::find(2);
            $browser->loginAs($user)
                    ->visit('/sendfeedback/create')
                    ->assertSee('Feedback');
                $browser->type('full_name', 'Duoc Nguyen C.')
                        ->type('email', 'duocduoc@gmail.com')
                        ->type('content', 'I am Duoc. Your website is very good. I like your website.')
                        ->press('SUBMIT')
                        ->assertSee('Sent Feedback!')
                        ->assertPathIs('/sendfeedback/create');   
                $this->assertDatabaseHas('feedbacks', [
                    'full_name' => 'Duoc Nguyen C.',
                    'email' => 'duocduoc@gmail.com',
                    'content' => 'I am Duoc. Your website is very good. I like your website.'
                ]);
        });
    }

    /**
     * Test validation page feedback of guest.
     *
     * @return void
     */
    public function testValidationFeedBackIfNotLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->logout()
                    ->visit('/sendfeedback/create')
                    ->assertSee('Feedback')
                    ->press('SUBMIT')
                    ->assertSee('The full name field is required.')
                    ->assertSee('The email field is required.')
                    ->assertSee('The content field is required.')
                    ->assertPathIs('/sendfeedback/create');
        });
    }

    /**
     * Test validation page feedback of user.
     *
     * @return void
     */
    public function testValidationFeedBackIfLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/sendfeedback/create')
                    ->assertSee('Feedback')
                    ->press('SUBMIT')
                    ->assertSee('The content field is required.')
                    ->assertPathIs('/sendfeedback/create');
        });
    }

    /**
     * List test case for feedback
     *
     */
    public function listTestCaseFeedback()
    {
        return [
            ['', 'duocnguyen@example.com', 'Good!', 'The full name field is required.'],
            ['Duoc Nguyen', '', 'Good!', 'The email field is required.'],
            ['Duoc Nguyen', 'duocnguyen@example.com', '', 'The content field is required.'],
            ['Duoc Nguyen', 'mail', 'Good!', 'The email must be a valid email address.
']
        ];
    }

    /**
     * @dataProvider listTestCaseFeedback
     *
     */
    public function testValidation($name, $email, $content, $expected)
    {
        $this->browse(function (Browser $browser) use ($name, $email, $content, $expected){
            $browser->visit('/sendfeedback/create')
                    ->assertSee('Feedback')
                    ->type('full_name', $name)
                    ->type('email', $email)
                    ->type('content', $content)
                    ->press('SUBMIT')
                    ->assertSee($expected)
                    ->assertPathIs('/sendfeedback/create');
        });
    }

    /**
     * Test button Reset of Guest.
     *
     * @return void
     */
    public function testButtonResetIfNotLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->logout()
                    ->visit('/sendfeedback/create')
                    ->assertSee('Feedback')
                    ->type('full_name', 'Duoc Nguyen')
                    ->type('email', 'duocnguyen@example.com')
                    ->type('content', 'Very good. I like your website')
                    ->press('RESET')
                    ->assertInputValue('full_name', '')
                    ->assertInputValue('email', '')
                    ->assertInputValue('content', '')
                    ->assertPathIs('/sendfeedback/create');
        });
    }

      /**
     * Test button Reset of user.
     *
     * @return void
     */
    public function testButtonResetIfLogin()
    {
        $this->makeData();
        $this->browse(function (Browser $browser) {
            $user = User::find(2);
            $browser->loginAs($user)
                    ->visit('/sendfeedback/create')
                    ->assertSee('Feedback')
                    ->assertInputValue('full_name', $user->full_name)
                    ->assertInputValue('email', $user->email)
                    ->assertInputValue('content', '')
                    ->type('full_name', 'Nguyen Cong Duoc')
                    ->type('email', 'duocduoc@example.com')
                    ->type('content', 'Very good. I like it')
                    ->press('RESET')
                    ->assertInputValue('full_name', $user->full_name)
                    ->assertInputValue('email', $user->email)
                    ->assertInputValue('content', '')
                    ->assertPathIs('/sendfeedback/create');
        });
    }

    /**
     * Test button Back.
     *
     * @return void
     */
    public function testButtonBack()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->clickLink('Feedback')
                    ->assertSee('Feedback')
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
        User::create([
            'username' => 'duocduoc',
            'password' => bcrypt('duocduoc'),
            'full_name' => 'Duoc Nguyen',
            'is_active' => 1,
            'email' => 'duocnguyen@gmail.com',
            'phone' => '01206223029'
        ]);
    }
}
