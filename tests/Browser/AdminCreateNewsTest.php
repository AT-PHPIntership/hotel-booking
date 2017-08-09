<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminCreateNewsTest extends DuskTestCase
{
    use DatabaseTransactions;

    /**
     * Test View Admin Create News.
     *
     * @return void
     */
    public function testCreatesNews()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news')
                    ->click('#btn-add-news')
                    ->assertPathIs('/admin/news/create')
                    ->screenShot(1);
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
                    ->assertSee('The category_id field is required.');
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
                    ->assertPathIs('/admin/news')
                    ->assertSee('Create News Success!');
        });
    }
  
    public function listCaseTestForCreateNews()
    {
        return [
            ['', 'Hello World!', '4', 'The title field is required.'],
            ['News55', '', '4', 'The content field is required.'],
            ['News55', 'Hello World!', '', 'The category_id field is required.'],
        ];
    }

    /**
     * @dataProvider listCaseTestForCreateNews
     *
     */
    public function testCreateNewsFail($title, $content, $category_id, $expected)
    {   
        
        $this->browse(function (Browser $browser) use($title, $content, $category_id) {
            
            $browser->visit('/admin/news/create')
                ->type('title', $title)
                ->type('content', $content)
                ->type('category_id', $category_id)
                ->screenShot('20')
                ->press('Submit')
                ->screenShot('10')
                ->assertSee($expected)
                ->assertPathIs('/admin/news');
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
            $browser->visit('/admin/news/create')
                    ->type('title','News10')
                    ->type('content','Hello')
                    ->screenShot('btn-rs')
                    ->press('Reset')
                    ->assertPathIs('/admin/news/create')
                    ->assertDontSee('News10')
                    ->assertDontSee('Hello');
        });
    }
}
