<?php

namespace Tests\Browser\Backend\News;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Model\Category;
use App\Model\News;

class AdminListNewsTest extends DuskTestCase
{   
    use DatabaseTransactions;
    /**
     * Test view Admin List News if databe has record or empty.   
     *
     * @return void
     */
    public function testListNews()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin')
                    ->click('#news-index')
                    ->screenShot('as')
                    ->assertSee('List News of Hotel')
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
                ->elements('#NewsTable tbody tr');
            $numAccounts = count($elements);
            $this->assertTrue($numAccounts == 0);
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
                 ->elements('#NewsTable tbody tr');
            $numAccounts = count($elements);
            $this->assertTrue($numAccounts == 10);
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
            $elements = $browser->visit('/admin/news')
                 ->elements('#NewsTable tbody tr');
            $numAccounts = count($elements);
            $this->assertTrue($numAccounts == 10);
            $elements = $browser->visit('/admin/news?page=2')
                 ->elements('#NewsTable tbody tr');
            $numAccounts = count($elements);
            $this->assertTrue($numAccounts == 5);
        });
    }

    /**
     * Make data for test.
     *
     * @return void
     */
    public function makeData($row)
    {   
        DB::table('news')->truncate();
        Model::unguard();
        $categoryIds = Category::all('id')->pluck('id')->toArray();
        $faker = Faker::create();
        for ($i = 0; $i < $row; $i++) {
            factory(News::class, 1)->create([
                'category_id' => $faker->randomElement($categoryIds),
            ]);
        }
        Model::reguard();
    }
}

