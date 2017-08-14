<?php

namespace Tests\Browser\Backend\News;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminCreateNewsTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test Route View Admin Create News.
     *
     * @return void
     */
    public function testCreatesNews()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news')
                    ->clickLink('Add News')
                    ->screenShot('add')
                    ->assertPathIs('/admin/news/create')
                    ->assertSee('ADD NEWS');
        });
    }

    /**
     * Test Validation Admin Create News.
     *
     * @return void
     */
    public function testValidationCreatesNews()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news/create')
                    ->press('Submit')
                    ->screenShot('3')
                    ->assertPathIs('/admin/news/create')
                    ->assertSee('The title field is required.')
                    ->assertSee('The content field is required.')
                    ->assertSee('The category id field is required.');
        });
    }

    /**
     * Test Admin create News success.
     *
     * @return void
     */
    public function testCreatesNewsSuccess()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news/create')
                    ->type('title','News18')
                    ->type('content','Hello World!')
                    ->type('category_id','6')
                    ->press('Submit')
                    ->screenShot('add-news')
                    ->assertPathIs('/admin/news')
                    ->assertSee('Create News Success!')
                    ->seeInDatabase('news', [
                        'title' => 'News18'])
                    ->screenShot('success');
        });
    }
    
    //  /**
    //  * Test Admin create News fail.
    //  *
    //  * @return void
    //  */
    // public function testCreatesNewsFail()
    // {
    //     $this->browse(function (Browser $browser) {
    //         $browser->visit('/admin/news/create')
    //                 ->type('title','News19')
    //                 ->type('content','Hello World!')
    //                 ->type('category_id','5')
    //                 ->press('Submit')
    //                 ->assertPathIs('/admin/news')
    //                 ->assertSee('Create News Fail!')
    //                 ->dontSeeInDatabase('news', [
    //                     'title' => 'News19'])
    //                 ->screenShot('fail');
    //     });
    // }

    // public function listCaseTestForCreateNews()
    // {
    //     return [
    //         ['', 'Hello World!', '4', 'The title field is required.'],
    //         ['News55', '', '4', 'The content field is required.'],
    //         ['News55', 'Hello World!', '', 'The category id field is required.'],
    //     ];
    // }

    // /**
    //  * @dataProvider listCaseTestForCreateNews
    //  *
    //  */
    // public function testCreateNewsFail($title, $content, $category_id, $expected)
    // {   
        
    //     $this->browse(function (Browser $browser) use($title, $content, $category_id, $expected) {
            
    //         $browser->visit('/admin/news/create')
    //             ->type('title', $title)
    //             ->type('content', $content)
    //             ->type('category_id', $category_id)
    //             ->press('Submit')
    //             ->screenShot('10');
    //             ->assertSee($expected)
    //             ->assertPathIs('/admin/news/create');
    //     });
    // }

    // /**
    //  * Test Button Reset
    //  *
    //  * @return void
    //  */
    // public function testBtnReset()
    // {
    //     $this->browse(function (Browser $browser) {
    //         $browser->visit('/admin/news/create')
    //                 ->type('title','News10')
    //                 ->type('content','Hello')
    //                 ->screenShot('btn-rs')
    //                 ->press('Reset')
    //                 ->assertPathIs('/admin/news/create')
    //                 ->assertDontSee('News10')
    //                 ->assertDontSee('Hello');
    //     });
    // }
}