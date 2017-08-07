<?php

// namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\DB;
use App\Model\RatingComment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;



class ListCommentTest extends DuskTestCase
{

    /**
     * A Dusk test content view's page.
     *
     * @return void
     */
    public function testContentView()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/comment')
                    ->assertSee('List Rating and Comment')
                    ->assertTitle('Admin | List comment');
        });
    }

    /**
     * A Dusk test content view's page.
     *
     * @return void
     */
    public function testRoute()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin')
                    ->click('#bt-rating-comment')
                    ->assertPathIs('/admin/comment');
        });
    }

    /**
     * A Dusk test when data empty.
     *
     * @return void
     */
    public function testRecordEmpty()
    {
       $this->browse(function (Browser $browser) {

            // truncate tabe 
            DB::table('rating_comments')->truncate();
            // begin test
            $browser->visit('/admin/comment')
                ->assertSee('List Rating and Comment');
            // count record
            $elements = $browser->elements('#list-table tbody tr');
            $row = count($elements);
            // compare
            $this->assertTrue($row == 0);
        });
    }

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testRecord()
    {
        $this->browse(function (Browser $browser) {
            // call make 10  record
            $this->makeData(10);
            // begin test
            $browser->visit('/admin/comment')
                ->assertSee('List Rating and Comment');
            $elements = $browser->elements('#list-table tbody tr');
            $row = count($elements);
            // compare
            $this->assertTrue($row == 10);

        });
    }


    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function makeData($row){
        // truncate table
        DB::table('rating_comments')->truncate();
        // factory
        Model::unguard();
                $hotelIds = App\Model\Hotel::all('id')->pluck('id')->toArray();
                $userIds = App\Model\User::all('id')->pluck('id')->toArray();
                $faker = Faker::create();
                for ($i = 0; $i < $row; $i++) {
                    factory(App\Model\RatingComment::class, 1)->create([
                        'hotel_id' => $faker->randomElement($hotelIds),
                        'user_id' => $faker->randomElement($userIds)
                    ]);
                }
         Model::reguard();
    }

}
