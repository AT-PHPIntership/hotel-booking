<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminEditNewsTest extends DuskTestCase
{   
    /**
     * Test Route Admin Edit News.
     *
     * @return void
     */
    public function testAdminEditNews()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news')
                    ->click('#btn-edit-news')
                    ->assertSee('EDIT NEWS');
        });
    }

      /**
     * Test Edit News Success.
     *
     * @return void
     */
    public function testEditNewsSuccess()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news')
                    ->click('#btn-edit-news')
                    ->assertSee('EDIT NEWS')
                    ->type('title','News20')
                    ->press('Submit')
                    ->assertSee('Edit News Success!')
                    ->seeInDatabase('news', [
                        'title' => 'News20'])
                    ->assertPathIs('/admin/news')
                    ->screenShot('edit-success');
        });
    }

    /**
     * Test Edit News Fail.
     *
     * @return void
     */
    public function testEditNewsFail()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news')
                    ->click('#btn-edit-news')
                    ->assertSee('EDIT NEWS')
                    ->press('Submit')
                    ->assertSee('Edit News Fail!')
                    ->assertPathIs('/admin/news')
                    ->screenShot('edit-fail');
        });
    }

    /**
     * Test Buton Cancer in page Edit News.
     *
     * @return void
     */
    public function testBtnCancer()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news')
                    ->click('#btn-edit-news')
                    ->assertSee('EDIT NEWS')
                    ->click('#cancer-edit-news')
                    ->assertSee('List News of Hotel')
                    ->assertPathIs('/admin/news');
        });
    }

    /**
     *List case for test validation Edit News
     *
     *@return array
     */
    public function listCaseTestForEditNews()
    {
        return [
            ['', 'content','The title field is required.'],
            ['news title', '', 'The content field is required.'],
        ];
    }

    /**
     * @dataProvider listCaseTestForEditNews
     *
     */
    public function testValidateEditNews($title, $content, $msg)
    {
        $this->browse(function (Browser $browser) use ($title, $content, $msg) {
            $browser->visit('/admin/news')
                    ->click('#btn-edit-news')
                    ->type('title',$title)
                    ->type('content',$content)
                    ->press('Submit')
                    ->assertSee($msg);
        });
    }
}
