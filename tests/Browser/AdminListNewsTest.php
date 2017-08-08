<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Model\News;
use App\Model\Category;
use Illuminate\Database\Eloquent\Model;
use DB;

class AdminListNewsTest extends DuskTestCase
{   
    use DatabaseTransactions;

    /**
     * Test view Admin List News.
     *
     * @return void
     */
    public function testListNews()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news')
                    ->assertSee('List News of Hotel');
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
        $categoryIds = App\Model\Category::all('id')->pluck('id')->toArray();
        $faker = Faker::create();
        for ($i = 0; $i < $row; $i++) {
            factory(App\Model\News::class, 1)->create([
                'category_id' => $faker->randomElement($categoryIds),
            ]);
        }
        Model::reguard();
    }
}
