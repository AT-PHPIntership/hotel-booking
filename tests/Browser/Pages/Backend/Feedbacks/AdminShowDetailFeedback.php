<?php

namespace Tests\Browser\Pages\Backend\Feedback;

use Tests\DuskTestCase;
use App\Model\Feedback;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Carbon\Carbon;

class AdminShowDetailFeedbackTest extends DuskTestCase
{   
    use DatabaseMigrations;

    /**
     * Make feedback data to testing
     */
    public function setUp()
    {
        parent::setUp();
        $feedback =  new Feedback(); 
        $feedback->full_name = 'Nhat Trung';
        $feedback->email = 'nhattrung@gmail.com';
        $feedback->content = 'Website is very great !';
        $feedback->created_at = Carbon::now('Asia/Bangkok');
        $feedback->save(); 
    }

    /**
     * Visit link feedback at feedback name
     * @param Browser $browser instance of browser
     * @param int $feedback feedback object  
     * @return Object
     */
    public function visitUrlFeedbackShow($browser, $feedback)
    {
        $page = $browser->visit('/admin/feedback')
            ->click('#table-contain tbody tr:nth-child(1) td:nth-child(5) a');
        $page->assertPathIs('/admin/feedback/' . $feedback->id)
            ->assertSee('Feedback detail');
        return $page;
    }

    /**
     * Test admin show detail feedback.
     *
     * @return void
     */
    public function testShowDetailFeedback()
    {
        $feedback = Feedback::find(1);
        $this->browse(function (Browser $browser) use ($feedback) {
            $page = $this->visitUrlFeedbackShow($browser, $feedback);
            $full_name = $page->text(".mailbox-read-info h3");
            $created_at = $page->text(".mailbox-read-info h5 span");
            $content = $page->text(".mailbox-read-message p");
            $this->assertTrue($full_name === 'From: '.$feedback->full_name);
            $this->assertTrue($created_at == $feedback->created_at);
            $this->assertTrue($content == $feedback->content);
            $page->assertSee($feedback->email);
        });
    }

    /**
     * Test 404 Page Not found when click url at feedback name .
     *
     * @return void
     */
    public function test404PageNotFound()
    {   
        $feedback = Feedback::find(1);
        $this->browse(function (Browser $browser) use ($feedback) {
            $browser->visit('/admin/feedback')->assertSee('List feedback');
            $feedback->delete();
            $browser->click('#table-contain tbody tr:nth-child(1) td:nth-child(5) a');
            $browser->assertSee('404 - Page Not found');
        });
    }

    /**
     * Test Button Back
     *
     * @return void
     */
    public function testBtnBack()
    {   
        $feedback = Feedback::find(1);
        $this->browse(function (Browser $browser) use ($feedback) {
            $this->visitUrlFeedbackShow($browser, $feedback) 
                ->click('#btn-go-back')
                ->assertPathIs('/admin/feedback');
        });
    }

     /**
     * Test Button delete
     *
     * @return void
     */
    public function testBtnDelete()
    {   
        $feedback = Feedback::find(1);
        $this->browse(function (Browser $browser) use ($feedback) {
            $page = $this->visitUrlFeedbackShow($browser, $feedback) 
                ->click('.btn-delete-item')
                ->waitForText("Confirm deletion!")
                ->press('Delete')
                ->assertSee("Delete success")
                ->assertPathIs('/admin/feedback')
                ->assertDontSee('Nhat Trung');
            $elements = $page->elements('#table-contain tbody tr');    
            $this->assertCount(0, $elements);
        });
    }
}
