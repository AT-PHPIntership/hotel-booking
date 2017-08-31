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

class AdminListNewsTest extends DuskTestCase
{   
    use DatabaseMigrations;

    /**
     * Test view Admin List News if databe has record or empty.   
     *
     * @return void
     */
    public function testListNews()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin')
                    ->clickLink('News')
                    ->assertSee('List News')
                    ->assertPathIs('/admin/news');
        });
    }

    /**
     * Test if DataBase has 0 record .
     *
     * @return void
     */
    public function testHasZeroRecordListNews()
    {   
        DB::table('news')->truncate();
        $this->browse(function (Browser $browser) {
            $elements = $browser->visit('/admin/news')
                ->elements('#newstable tbody tr');
            $numAccounts = count($elements);
            $this->assertTrue($numAccounts == 0);
            $browser->assertPathIs('/admin/news');
        });
    }

    /**
     * Test if DataBase has 10 record .
     *
     * @return void
     */
    public function  testHasTenRecordListNews()
    {   
        $this->makeData(10);
        $this->browse(function (Browser $browser) {
            $elements = $browser->visit('/admin/news')
                 ->elements('#newstable tbody tr');
            $numAccounts = count($elements);
            $this->assertTrue($numAccounts == 10);
            $browser->assertPathIs('/admin/news');
        });
    }

    /**
     * Test if DataBase has  > 10 record.
     *
     * @return void
     */
    public function  testHasMoreRecordListNews()
    {  
        $this->makeData(15);
        $this->browse(function (Browser $browser) {
            $elements = $browser->visit('/admin/news?page=1')
                        ->elements('#newstable tbody tr');
            $numAccounts = count($elements);
            $this->assertTrue($numAccounts == 10);
            $browser->assertPathIs('/admin/news');
            $browser->assertQueryStringHas('page', '1');

            $elements = $browser->visit('/admin/news?page=2')
                 ->elements('#newstable tbody tr');
            $numAccounts = count($elements);
            $this->assertTrue($numAccounts == 5);
            $browser->assertPathIs('/admin/news');
            $browser->assertQueryStringHas('page', '2');
        });
    }

    /**
     * Test button Pagination.
     *
     * @return void
     */
    public function testButtonPaginate()
    {
        $this->makeData(25);
        $this->browse(function (Browser $browser) {
        $paginate_element = $browser->visit('/admin/news')
                                    ->resize(1920, 2000)           
                                    ->elements('.pagination li');
        $number_page = count($paginate_element) - 2;
        $this->assertTrue($number_page == 3);
        });
    }

    /**
     * Make data for test.
     *
     * @return void
     */
    public function makeData($row)
    {   
        factory(Category::class, 10)->create();
        $categoryIds = Category::all('id')->pluck('id')->toArray();
        $faker = Faker::create();
        for ($i = 0; $i < $row; $i++) {
            factory(News::class, 1)->create([
                'category_id' => $faker->randomElement($categoryIds),
            ]);
        }
    }
}

