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
     * Test search .
     *
     * @return void
     */
    // public function testSearch()
    // {
    //     $this->browse(function (Browser $browser) {
    //         $browser->visit('/admin/news')
    //                 ->assertSee('List News of Hotel');
    //     });
    // }


    /**
     *Test search if not input value.
     *
     * @return void
     */
    // public function testSearchNotInputValue()
    // {
    //     for ($i=1; $i <= 10 ; $i++) { 
    //         Category::create([
    //             'name' => 'News'.$i
    //             ]);
    //     }
    //     for ($i=1; $i < 11 ; $i++) { 
    //         News::create([
    //             'title' => 'Title '.$i,
    //             'content' => 'Content '.$i,
    //             'category_id' => $i
    //             ]);
    //     }
    //     $this->browse(function (Browser $browser) {
    //         $elements = $browser->visit('/admin/news')
    //                 ->screenShot('aa')
    //                 ->elements('#newstable tbody tr');
    //         $browser->press('.glyphicon-search');
    //         $numAccounts = count($elements);
    //         $this->assertTrue($numAccounts == 10);   
    //     });
    // }

    /**
     *Test search if not input value.
     *
     * @return void
     */
    public function testSearchHasInputValue()
    {
        for ($i=1; $i <= 10 ; $i++) { 
            Category::create([
                'name' => 'News'.$i
                ]);
        }
        for ($i=1; $i <= 10 ; $i++) { 
            News::create([
                'title' => 'Title '.$i,
                'content' => 'Content '.$i,
                'category_id' => $i
                ]);
        }
        $this->browse(function (Browser $browser) {
            
            $browser->visit('/admin/news')
                    ->type('search', 'News2')
                    ->press('.btn-search');
            $numAccounts = count($elements);
            echo $numAccounts;
            $this->assertTrue($numAccounts == 1);   
        });
    }

}

    