<?php

namespace Tests\Browser\Backend\RatingComments;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;
use App\Model\Hotel;
use App\Model\User;
use App\Model\RatingComment;

class ListCommentTest extends DuskTestCase
{

    /**
     * A Dusk test ULR, Content, Route.
     *
     * @return void
     */
    public function testULR()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('admin')
                ->click('#bt-rating-comment')
                ->assertPathIs('/admin/comment')
                ->assertSee('List comment & rating')
                ->assertTitle('Admin | List comment');
        });
    }

    /**
     * A Dusk test record when emptydata.
     *
     * @return void
     */
    public function testEmptyData()    
    {
        $this->browse(function (Browser $browser) {
            // truncate tabe 
            DB::table('rating_comments')->truncate();
            // begin test
            $browser->visit('/admin/comment')
                ->assertSee('List comment & rating');
            // count record
            $elements = $browser->elements('#list-table tbody tr');
            $row = count($elements);
            // compare
            $this->assertTrue($row == 0);
        });
    }

    /**
     * A Dusk test record when has 10.
     *
     * @return void
     */
    public function testHasData()    
    {        
        $this->browse(function (Browser $browser) {
            // insert data
            $this->makeData(10);
            // begin test
            $browser->visit('/admin/comment')
                ->assertSee('List comment & rating');
            // count record
            $elements = $browser->elements('#list-table tbody tr');
            $row = count($elements);
            // compare
            $this->assertTrue($row == 10);
        });
    }

    /**
     * A Dusk test pagination when it has 18 record
     * visit page 2 assertSee 8 row data
     *
     * @return void
     */
    public function testPagination()    
    {        
        $this->browse(function (Browser $browser) {
            $this->makeData(18);
            // begin test
            $browser->visit('admin/comment?page=2')
                ->assertSee('List comment & rating')
                ->screenShot('1');
            // count record
            $elements = $browser->elements('#list-table tbody tr');
            $row = count($elements);
            // compare
            $this->assertTrue($row == 8);
        });
    }

    /**
     * This function insert data for test.
     *
     * @return void
     */
    public function makeData($row){
        // truncate table
        DB::table('rating_comments')->truncate();
        // factory
        Model::unguard();
        $hotelIds = Hotel::all('id')->pluck('id')->toArray();
        $userIds = User::all('id')->pluck('id')->toArray();
        $faker = Faker::create();
        for ($i = 0; $i < $row; $i++) {
            factory(RatingComment::class, 1)->create([
                'hotel_id' => $faker->randomElement($hotelIds),
                'user_id' => $faker->randomElement($userIds)
            ]);
        }
         Model::reguard();
    }
}
