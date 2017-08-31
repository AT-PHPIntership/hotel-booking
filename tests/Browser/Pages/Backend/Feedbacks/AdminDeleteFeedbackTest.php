<?php

namespace Tests\Browser\Pages\Backend\Feedbacks;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\Feedback;

class AdminDeleteFeedbackTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Init data for test
     */
    public function setUp()
    {
        parent::setUp();
        $feedback =  new Feedback(); 
        $feedback->full_name = 'Nhat Trung';
        $feedback->email = 'nhattrung@gmail.com';
        $feedback->content = 'Website is very great !';
        $feedback->save();  
         
    }

    /**
     * Click button delete feedback
     * @param Browser $browser instance of Browser
     * @return $page
     */
    public function clickDeleteFeedback($browser)
    {   
        $page = $browser->visit('/admin/feedback');
        $page->press('#table-contain tbody tr:nth-child(1) td:nth-child(5) button')
        ->waitForText("Confirm deletion!")
        ->press('Delete');
        return $page;
    }  

    /**
     * Test delete feedback success
     *
     * @return void
     */
    public function testDeleteSuccess() 
    {
         
        $this->browse(function (Browser $browser) {
            $page = $this->clickDeleteFeedback($browser);
            $page->assertSee("Delete success");
            $this->assertSoftDeleted('feedbacks', ['id' => '1']);
            $elements = $page->elements('#table-contain tbody tr');    
            $this->assertCount(0, $elements);    
        });
    } 

    /**
     * Test not found feedback
     *
     * @return void
     */
    public function testNotFound()
    {   
        $this->browse(function (Browser $browser) {
            $page = $browser->visit('/admin/feedback');
            $feedback = Feedback::find(1);
            $feedback->delete();
            $page->press('#table-contain tbody tr:nth-child(1) td:nth-child(5) button')
                ->waitForText("Confirm deletion!")
                ->press('Delete')
                ->assertSee("404 - Page Not found");
        });  
    }
}
