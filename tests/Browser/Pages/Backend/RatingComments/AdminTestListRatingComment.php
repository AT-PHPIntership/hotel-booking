<?php

namespace Tests\Browser\Pages\Backend\RatingComments;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Faker\Factory as Faker;
use App\Model\Hotel;
use App\Model\User;
use App\Model\RatingComment;
use App\Model\Place;

class AdminTestListRatingComment extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test view Admin List comment if databe has record or empty.   
     *
     * @return void
     */
    public function testListRatingComment()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin')
                    ->clickLink('Comment and Rating')
                    ->assertSee('List comment & rating')
                    ->assertPathIs('/admin/comment');
        });
    }

    /**
     * A Dusk test show record with table empty.
     *
     * @return void
     */
    public function testListEmpty()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/comment')
                ->assertSee('List comment & rating');
            $elements = $browser->elements('#list-table tbody tr');
            $this->assertCount(0, $elements);
            $this->assertNull($browser->element('.paginate'));
        });
    }

    /**
     * A Dusk test show record with table has data.
     *
     * @return void
     */
    public function testListHasRecord()
    {
        $this->makeData(9);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/comment')
                ->resize(1920, 2000)
                ->assertSee('List comment & rating');
            $elements = $browser->elements('#list-table tbody tr');
            $this->assertCount(9, $elements);
            $this->assertNull($browser->element('.pagination'));
        });
    }

    /**
    * A Dusk test show record with table has data and ensure pagnate.
    *
    * @return void
    */
    public function testShowRecordPaginate()
    {
        $this->makeData(21);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/comment')
                ->resize(1920, 2000)
                ->assertSee('List comment & rating');
            //Count row number in one page    
            $elements = $browser->elements('#list-table tbody tr');
            $this->assertCount(10, $elements);
            $this->assertNotNull($browser->element('.pagination'));

            //Count page number of pagination
            $paginate_element = $browser->elements('.pagination li');
            $number_page = count($paginate_element)- 2;
            $this->assertTrue($number_page == 3);
        });
    }

    /**
     * Test click page 2 in pagination link
     *
     * @return void
     */
    public function testPathPagination()
    {   
        $this->makeData(12);
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/comment?page=2');
            $elements = $browser->elements('#list-table tbody tr');
            $this->assertCount(2, $elements);
            $browser->assertPathIs('/admin/comment');
            $browser->assertQueryStringHas('page', 2);
        });
    }

    /**
     * Make data for test.
     *
     * @return void
     */
    public function makeData($row)
    {   
        factory(Place::class, 10)->create();

        $placeIds = Place::all('id')->pluck('id')->toArray();
        $faker = Faker::create();
        for ($i = 0; $i < 10; $i++) {
            factory(Hotel::class, 1)->create([
                'place_id' => $faker->randomElement($placeIds)
            ]);
        }

        factory(User::class, 10)->create();
        $hotelIds = Hotel::all('id')->pluck('id')->toArray();
        $userIds = User::all('id')->pluck('id')->toArray();
        $faker = Faker::create();
        for ($i = 0; $i < $row; $i++) {
            factory(RatingComment::class, 1)->create([
                'hotel_id' => $faker->randomElement($hotelIds),
                'user_id' => $faker->randomElement($userIds)
            ]);
        }
    }
}
