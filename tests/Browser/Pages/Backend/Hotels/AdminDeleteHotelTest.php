<?php

namespace Tests\Browser\Pages\Backend\Hotels;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\Place;
use App\Model\Hotel;
use App\Model\Room;
use App\Model\User;
use App\Model\RatingComment;
use Faker\Factory as Faker;

class AdminDeleteHotelTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test delete hotel success
     *
     * @return void
     */
    public function testDeleteSuccess() 
    {
        $this->makeData(10);
        $hotel = Hotel::find(5);
        $this->browse(function (Browser $browser) use ($hotel){
            $page = $browser->visit('/admin/hotel');
            $elements = $page->elements('#table-contain tbody tr');
            $this->assertCount(10, $elements);
            $page->press('#table-contain tbody tr:nth-child(6) td:nth-child(8) button')
                ->waitForText("Confirm deletion!")
                ->press('Delete')
                ->assertSee("Deletion successful");
            $this->assertSoftDeleted('hotels', ['id' => '5']);
            $elements = $page->elements('#table-contain tbody tr');   
            $this->assertCount(9, $elements);
            $browser->assertPathIs('/admin/hotel')
                ->assertDontSee($hotel->name); 
        });
    } 

    /**
     * Test not found when delete hotel
     *
     * @return void
     */
    public function testNotFound()
    {   
        $this->makeData(5);
        $this->browse(function (Browser $browser) {
            $page = $browser->visit('/admin/hotel');
            $hotel = Hotel::find(2);
            $hotel->delete();
            $page->press('#table-contain tbody tr:nth-child(4) td:nth-child(8) button')
                ->waitForText("Confirm deletion!")
                ->press('Delete')
                ->assertSee("404 - Page Not found");
        });
    }

    /**
     * 
     * Test delete hotel's relationship with comments and rooms 
     * 
     * @return void
     */
    public function testDeleteRelationship()
    {
        $this->makeData(1);
        factory(User::class, 1)->create();
        for ($i = 0; $i < 5; $i++) {
            factory(Room::class, 1)->create([
                'hotel_id' => '1'
            ]);
        }
        for ($i = 0; $i < 5; $i++) {
            factory(RatingComment::class, 1)->create([
                'hotel_id' => '1',
                'user_id' => '1',
                'comment' => 'this is comment '.$i
            ]);
        }
        $hotel = Hotel::find(1);
        $this->browse(function (Browser $browser) {
            $page = $browser->visit('/admin/hotel');
            $page->press('#table-contain tbody tr:nth-child(1) td:nth-child(8) button')
            ->waitForText("Confirm deletion!")
            ->press('Delete')
            ->assertSee("Deletion successful!");
        });
        $rooms = $hotel->rooms()->get();
        $ratingComments = $hotel->ratingComments()->get();
        $this->assertCount(0, $rooms);
        $this->assertCount(0, $ratingComments);
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
        for ($i = 0; $i < $row; $i++) {
            factory(Hotel::class, 1)->create([
                'place_id' => $faker->randomElement($placeIds)
            ]);
        }
    }
}
