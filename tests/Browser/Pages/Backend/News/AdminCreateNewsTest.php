<?php

namespace Tests\Browser\Pages\Backend\News;

use Tests\DuskTestCase;
use Illuminate\Http\UploadedFile;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\Category;

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
                    ->assertPathIs('/admin/news/create')
                    ->assertSee('The title field is required.')
                    ->assertSee('The content field is required.')
                    ->assertSee('The category id field is required.')
                    ->assertSee('The images field is required.');
        });
    }

    /**
     * Test Admin create News success.
     *
     * @return void
     */
    public function testCreatesNewsSuccess()
    {   
        factory(Category::class,10)->create();
        $category = Category::find(1);
        $this->browse(function (Browser $browser) use ($category) {
            $image = $this->fakeFile(true);
            $page = $browser->visit('/admin/news/create')
                ->type('title','News18')
                ->attach('images[]', $image);
            $this->typeInCKEditor($browser, '#cke_content iframe', 'Hello World!');
            $page->select('category_id', $category->id)
                ->press('Submit')
                ->assertPathIs('/admin/news')
                ->assertSee('Create News Success!');
        });
        $this->assertDatabaseHas('news', [
            'title' => 'News18'
        ]); 
    }
    
    /**
     * List case for Test Validation Create News
     *
     */
    public function listCaseTestForCreateNews()
    {
        return [
            ['', 'Hello World!', '5', $this->fakeFile(true), 'The title field is required.'],
            ['News55', '', '5', $this->fakeFile(true), 'The content field is required.'],
            ['News55', 'Hello World!', '', $this->fakeFile(true), 'The category id field is required.'],
            ['News55', 'Hello World!', '5', '', 'The images field is required.'],
            ['News55', 'Hello World!', '5', $this->fakeFile(false), 'The images.0 must be an image.'],
        ];
    }

    /**
     *
     * @dataProvider listCaseTestForCreateNews
     *
     */
     
    public function testCreateNewsFail($title, $content, $category_id, $image, $expected)
    {   
        
        $this->browse(function (Browser $browser) use ($title, $content,
            $category_id, $image, $expected) {
            $page = $browser->visit('/admin/news/create')
                ->type('title', $title)
                ->attach('images[]', $image);
            $this->typeInCKEditor($browser, '#cke_1_contents iframe', $content);    
            $page->select('category_id', $category_id)
                ->press('Submit')
                ->assertSee($expected)
                ->assertPathIs('/admin/news/create');
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
            $image = $this->fakeFile(true);
            $page = $browser->visit('/admin/news/create')
                ->type('title', 'News10')
                ->attach('images[]', $image);
            $this->typeInCKEditor($browser, '#cke_1_contents iframe', 'Hello');
            $page->select('category_id')
                ->press('Reset')
                ->assertPathIs('/admin/news/create')
                ->assertInputValueIsNot('', '');
        });
    }

    /**
     * Test Button Back
     *
     * @return void
     */
    public function testBtnBack()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news/create')
                    ->clickLink('Back')
                    ->assertPathIs('/admin/news');
        });
    }

    /**
     * Fake image 
     * 
     * @param boolean $isImage check file is image
     * 
     * @return string
     */
    public function fakeFile($isImage)
    { 
        $file = $isImage ? UploadedFile::fake()->image('image.jpg') : UploadedFile::fake()->create('file.pdf');
        return $file;
    }

}
