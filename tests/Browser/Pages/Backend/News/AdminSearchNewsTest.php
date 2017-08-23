<?php

namespace Tests\Browser\Pages\Backend\News;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Model\Category;
use App\Model\News;

class AdminSearchNewsTest extends DuskTestCase
{   
    use DatabaseMigrations;

    /**
     *Test search if not input value.
     *
     * @return void
     */
    public function testSearchNotInputValue()
    {
        $this->makeData(10);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news')
                    ->press('.btn-search')
                    ->assertPathIs('/admin/news')
                    ->assertQueryStringMissing('search');
        });
    }

    /**
     *Test search if has input value and has one record.
     *
     * @return void
     */
    public function testSearchHasInputValue()
    {
        $this->makeData(10);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news')
                    ->type('search', 'News2')
                    ->press('.btn-search');
            $elements = $browser->elements('#newstable tbody tr');
            $numAccounts = count($elements);
            $this->assertTrue($numAccounts == 1);   
        });
    }

    /**
     *Test search has input value but not found.
     *
     * @return void
     */
    public function testSearchNotResult()
    {
        $this->makeData(10);
        $this->browse(function (Browser $browser) {     
            $browser->visit('/admin/news')
                    ->type('search', 'Nsdsad')
                    ->press('.btn-search');
            $elements = $browser->elements('#newstable tbody tr');
            $numAccounts = count($elements);
            $this->assertTrue($numAccounts == 0);
            $browser->assertSee('Data Not Found');
        });
    }

    /**
     *Test search has input value and has many record.
     *
     * @return void
     */
    public function testHasManyRecord()
    {
        $this->makeData(15);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news')
                    ->type('search', 'News')
                    ->press('.btn-search');
            $elements = $browser->visit('/admin/news?search=News&page=1')
                                ->elements('#newstable tbody tr');
            $numAccounts = count($elements);
            $this->assertTrue($numAccounts == 10);
            $browser->assertPathIs('/admin/news')
                    ->assertQueryStringHas('search', 'News')
                    ->assertQueryStringHas('page', '1');
            $elements = $browser->visit('/admin/news?search=News&page=2')
                                ->elements('#newstable tbody tr');
            $numAccounts = count($elements);
            $this->assertTrue($numAccounts == 5);
            $browser->assertPathIs('/admin/news')
                    ->assertQueryStringHas('search', 'News')
                    ->assertQueryStringHas('page', '2');
        }); 
    }

    /**
     * Make data for test
     *
     * @return void
     */
    public function makeData($row)
    {
        for ($i=1; $i <= $row ; $i++) { 
            Category::create([
                'name' => 'News'.$i
                ]);
        }
        for ($i=1; $i <= $row ; $i++) { 
            News::create([
                'title' => 'Title '.$i,
                'content' => 'Content '.$i,
                'category_id' => $i
                ]);
        }
    }
}   

