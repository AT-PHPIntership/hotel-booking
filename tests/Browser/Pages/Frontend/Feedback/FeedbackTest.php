<?php

namespace Tests\Browser\Pages\Frontend\Feedback;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use App\Model\Feedback;

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
                    ->assertPathIs('/feedback');
        });
    }

    /**
     * Test value of page feedback.
     *
     * @return void
     */
    public function testValuePageFeedBack()
    {
        $this->browse(function (Browser $browser) {
            $browser->logout()
                    ->visit('/feedback')
                    ->assertSee('Feedback');
            if (Auth::user()) {
                $browser->assertInputValue('full_name', Auth::user()->full_name)
                        ->assertInputValue('email', Auth::user()->email)
                        ->assertInputValue('content', '')
                        ->assertPathIs('/feedback');
            } else {
                $browser->assertInputValue('full_name', '')
                        ->assertInputValue('email', '')
                        ->assertInputValue('content', '')
                        ->assertPathIs('/feedback');
            }
        });
    }

    /**
     * Test send feedback Success.
     *
     * @return void
     */
    public function testFeedBackSuccess()
    {
        $this->browse(function (Browser $browser) {
            $browser->logout()
                    ->visit('/feedback')
                    ->assertSee('Feedback');
            if (Auth::user()) {
                $browser->type('content', 'Very good')
                        ->press('SUBMIT')
                        ->assertSee('Sent Feedback!')
                        ->assertPathIs('/feedback');
                $this->assertDatabaseHas('feedbacks', [
                    'full_name' => Auth::user()->full_name,
                    'email' => Auth::user()->email,
                    'content' => 'Very good'
                ]); 
            } else {
                $browser->type('full_name', 'Duoc Nguyen')
                        ->type('email', 'duocnguyen@example.com')
                        ->type('content', 'Very good. I like your website')
                        ->press('SUBMIT')
                        ->assertSee('Sent Feedback!')
                        ->assertPathIs('/feedback');
                $this->assertDatabaseHas('feedbacks', [
                    'full_name' => 'Duoc Nguyen',
                    'email' => 'duocnguyen@example.com',
                    'content' => 'Very good. I like your website'
                ]);
            }
        });
    }

    /**
     * Test validation page feedback.
     *
     * @return void
     */
    public function testValidationFeedBack()
    {
        $this->browse(function (Browser $browser) {
            $browser->logout()
                    ->visit('/feedback')
                    ->assertSee('Feedback');
            if (Auth::user()) {
                $browser->press('SUBMIT')
                        ->assertSee('The content field is required.')
                        ->assertPathIs('/feedback');
            } else {
                $browser->press('SUBMIT')
                        ->assertSee('The full name field is required.')
                        ->assertSee('The email field is required.')
                        ->assertSee('The content field is required.')
                        ->assertPathIs('/feedback');
            }
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
            $browser->visit('/feedback')
                    ->assertSee('Feedback')
                    ->type('full_name', $name)
                    ->type('email', $email)
                    ->type('content', $content)
                    ->press('SUBMIT')
                    ->assertSee($expected)
                    ->assertPathIs('/feedback');
        });
    }

    /**
     * Test button Reset.
     *
     * @return void
     */
    public function testButtonReset()
    {
        $this->browse(function (Browser $browser) {
            $browser->logout()
                    ->visit('/feedback')
                    ->assertSee('Feedback');
            if (Auth::user()) {
                $browser->type('content', 'Very good. I like it')
                        ->press('RESET')
                        ->assertSee('The content field is required.')
                        ->assertInputValue('content', '')
                        ->assertPathIs('/feedback');
            } else {
                $browser->type('full_name', 'Duoc Nguyen')
                        ->type('email', 'duocnguyen@example.com')
                        ->type('content', 'Very good. I like your website')
                        ->press('RESET')
                        ->assertInputValue('full_name', '')
                        ->assertInputValue('email', '')
                        ->assertInputValue('content', '')
                        ->assertPathIs('/feedback');
            }
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
            $browser->visit('/feedback')
                    ->assertSee('Feedback')
                    ->clickLink('Back')
                    ->assertSee('Outstanding Places')
                    ->assertPathIs('/');
        });
    }
}
