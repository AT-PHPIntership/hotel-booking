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

class AdminDeleteCommentTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test delete comment success
     *
     * @return void
     */
    public function testDeleteSuccess() 
    {
        $this->makeData(10);
        $comment = RatingComment::find(5);
        $this->browse(function (Browser $browser) use ($comment){
            $page = $browser->visit('/admin/comment');
            $elements = $page->elements('#list-table tbody tr');
            $this->assertCount(10, $elements);
            $page->press('#list-table tbody tr:nth-child(6) td:nth-child(7) button')
            ->waitForText("Confirm deletion!")
            ->press('Delete')
            ->assertSee("Deletion successful");
            // check softdeleted
            $this->assertSoftDeleted('rating_comments', ['id' => '5']);
            // check show
            $elements = $page->elements('#list-table tbody tr');   
            $this->assertCount(9, $elements);
            $page->assertDontSee($comment->comment); 
        });
    } 

    /**
     * Test not found when delete
     *
     * @return void
     */
    public function testNotFound()
    {   
        $this->makeData(5);
        $this->browse(function (Browser $browser) {
            $page = $browser->visit('/admin/comment');
            $rating_comments = RatingComment::find(2);
            $rating_comments->delete();
            $page->press('#list-table tbody tr:nth-child(4) td:nth-child(7) button')
                ->waitForText("Confirm deletion!")
                ->press('Delete')
                ->assertSee("404 - Page Not found");
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
                'user_id' => $faker->randomElement($userIds),
                'comment' => 'this is comment '.$i
            ]);
        }
    }
}
