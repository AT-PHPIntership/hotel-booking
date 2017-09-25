<?php

namespace Tests\Browser\Pages\Frontend\RatingComments;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\Place;
use App\Model\Hotel;
use App\Model\User;
use App\Model\RatingComment;

class UserCreateDeleteRatingComment extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A Dusk test route create rating comment in detail hotel page.
     *
     * @return void
     */
    public function testCreateRatingComment()
    {
        $this->makeData();
        $hotel = Hotel::find(1);
        $this->browse(function (Browser $browser) use ($hotel) {
            $browser->visit('/hotels/' . $hotel->slug);
        });
        $this->assertNotNull('#section-rating-comment');
    }

    /**
     * Test Validation Create rating comment.
     *
     * @return void
     */
    public function testValidationCreateRatingComment()
    {
        $this->makeData();
        $hotel = Hotel::find(1);
        $this->browse(function (Browser $browser) use ($hotel) {
            $browser->visit('/hotels/' . $hotel->slug)
                ->press('SUBMIT')
                ->assertPathIs('/hotels/' . $hotel->slug)
                ->assertSee('The comment field is required.');
        });
    }

    /**
     * Test create rating comment success.
     *
     * @return void
     */
    public function testCreatesCategorySuccess()
    {
        $this->makeData();
        $this->makeUser();
        $hotel = Hotel::find(1);
        $user = User::find(1);
        $this->browse(function (Browser $browser) use ($hotel, $user) {
            $browser->logout();
            $browser->loginAs($user)
                ->visit('/hotels/' . $hotel->slug)
                ->type('comment', 'This is good hotels for me!')
                ->assertSeeIn('#food-value', 5)
                ->assertSeeIn('#cleanliness-value', 5)
                ->assertSeeIn('#comfort-value', 5)
                ->assertSeeIn('#service-value', 5)
                ->assertSeeIn('#location-value', 5)
                ->assertInputValue('total_rating', 5)
                ->press('SUBMIT')
                ->assertSee('You have commented successfully!');
        });
        $this->assertDatabaseHas('rating_comments', [
                'comment' => 'This is good hotels for me!',
                'total_rating' => 5,
                'user_id' => $user->id,
                'hotel_id' => $hotel->id
            ]);
    }

    /**
     * A Dusk test Delete success.
     *
     * @return void
     */
    public function testDeleteSuccess()
    {
        $this->makeData();
        $this->makeUser();
        $this->makeComment(1, 1);
        $hotel = Hotel::find(1);
        $user = User::find(1);
        $comment = RatingComment::find(1);
        $this->browse(function (Browser $browser) use ($hotel, $user, $comment) {
            $browser->logout();
            $browser->loginAs($user)
                ->visit('/hotels/' . $hotel->slug)
                ->assertSeeIn('.cls-contain-comment h3', 'Comment ( 1 )')
                ->assertSeeIn('.cls-contain-comment .col-md-12.comment-old .cls-username-comment', $user->username)
                ->press('.cls-contain-comment .col-md-12.comment-old button')
                ->waitForText('Confirm deletion!')
                ->click('#delete-btn')
                ->assertSee('Delete success')
                ->assertSeeIn('.cls-contain-comment h3', 'Comment ( 0 )');
        });
    }

    /**
     * A Dusk test Delete succeed.
     *
     * @return void
     */
    public function testDeleteNotFound()
    {
        $this->makeData();
        $this->makeUser();
        $this->makeComment(1, 1);
        $hotel = Hotel::find(1);
        $user = User::find(1);
        $comment = RatingComment::find(1);
        $this->browse(function (Browser $browser) use ($hotel, $user, $comment) {
            $browser->logout();
            $browser->loginAs($user)
                ->visit('/hotels/' . $hotel->slug)
                ->assertSeeIn('.cls-contain-comment h3', 'Comment ( 1 )')
                ->assertSeeIn('.cls-contain-comment .col-md-12.comment-old .cls-username-comment', $user->username)
                ->press('.cls-contain-comment .col-md-12.comment-old button')
                ->waitForText('Confirm deletion!');
            $comment->delete();
            $this->assertSoftDeleted('rating_comments', ['id'=>'1']);
            $browser->click('#delete-btn')
                    ->assertSee('404 - Page Not found');
        });
    }

    /**
     * Make data for test.
     *
     * @return void
     */
    public function makeData()
    {   
        factory(Place::class, 1)->create();
        factory(Hotel::class, 1)->create([
            'place_id' => 1
        ]);
    }

    /**
     * Make user for login.
     *
     * @return void
     */
    public function makeUser()
    {   
        factory(User::create([
            'username' => 'user1',
            'password' => bcrypt('user1'),
            'email' => 'user1@gmail.com',
            'full_name' => 'User1',
            'phone' => '0123456789',
            'is_active' => 1,
            'is_admin' => 0
            ])
        );
    }

    /**
     * Make comment of user had id = idUser for hotel has id = idHotel.
     *
     * @return void
     */
    public function makeComment($idUser, $idHotel)
    {   
        factory(RatingComment::class, 1)->create([
            'hotel_id' => $idHotel,
            'user_id' => $idUser
        ]);
    }
}
