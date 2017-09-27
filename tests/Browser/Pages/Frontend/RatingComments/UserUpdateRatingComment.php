<?php

namespace Tests\Browser\Pages\Frontend\RatingComments;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\Place;
use App\Model\Hotel;
use App\Model\User;
use App\Model\RatingComment;

class UserUpdateRatingComment  extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * Test see exactly information.
     *
     * @return void
     */
    public function testUpdateRatingComment()
    {
        $hotel = $this->makeData();
        $user = $this->makeUser();
        $comment = $this->makeComment(1, 1);
        $this->browse(function (Browser $browser) use ($hotel, $user, $comment) {
            $browser->logout();
            $browser->loginAs($user)
                ->visit('/hotels/' . $hotel->slug)
                ->assertSeeIn('.cls-contain-comment h3', 'Comment ( 1 )')
                ->assertSeeIn('.cls-contain-comment .col-md-12.comment-old .cls-username-comment', $user->username)
                ->press('.cls-contain-comment .col-md-12.comment-old a')
                ->assertSee('Do you want to update comment?')
                ->assertInputValue('total_rating', $comment->total_rating)
                ->assertInputValue('comment', $comment->comment);
        });
    }

    /**
     * Test Edit News Success.
     *
     * @return void
     */
    public function testUpdateRatingCommentSuccess()
    {
        $hotel = $this->makeData();
        $user = $this->makeUser();
        $comment = $this->makeComment(1, 1);
        $this->browse(function (Browser $browser) use ($hotel, $user, $comment) {
            $browser->logout();
            $browser->loginAs($user)
                ->visit('/hotels/' . $hotel->slug)
                ->assertSeeIn('.cls-contain-comment h3', 'Comment ( 1 )')
                ->assertSeeIn('.cls-contain-comment .col-md-12.comment-old .cls-username-comment', $user->username)
                ->press('.cls-contain-comment .col-md-12.comment-old a')
                ->assertSee('Do you want to update comment?')
                ->type('comment', 'This is good hotels for me!')
                ->press('SUBMIT')
                ->assertSee('You was edit comment successfully !')
                ->assertPathIs('/hotels/' . $hotel->slug);
        });
        $this->assertDatabaseHas('rating_comments', [
                'comment' => 'This is good hotels for me!',
                'total_rating' => $comment->total_rating,
                'user_id' => $user->id,
                'hotel_id' => $hotel->id
            ]);
    }

    /**
     * Test Buton Cancel Update.
     *
     * @return void
     */
    public function testBtnCancel()
    {
        $hotel = $this->makeData();
        $user = $this->makeUser();
        $comment = $this->makeComment(1, 1);
        $this->browse(function (Browser $browser) use ($hotel, $user, $comment) {
            $browser->logout();
            $browser->loginAs($user)
                ->visit('/hotels/' . $hotel->slug)
                ->assertSeeIn('.cls-contain-comment h3', 'Comment ( 1 )')
                ->assertSeeIn('.cls-contain-comment .col-md-12.comment-old .cls-username-comment', $user->username)
                ->press('.cls-contain-comment .col-md-12.comment-old a')
                ->assertSee('Do you want to update comment?')
                ->assertInputValue('total_rating', $comment->total_rating)
                ->assertInputValue('comment', $comment->comment)
                ->clickLink('Cancel')
                ->assertInputValue('total_rating', 5)
                ->assertInputValue('comment', '')
                ->assertPathIs('/hotels/' . $hotel->slug);
        });
    }

    /**
     * Test Validation update rating comment.
     *
     * @return void
     */
    public function testValidationUpdateRatingComment()
    {
        $hotel = $this->makeData();
        $user = $this->makeUser();
        $comment = $this->makeComment(1, 1);
        $this->browse(function (Browser $browser) use ($hotel, $user, $comment) {
            $browser->logout();
            $browser->loginAs($user)
                ->visit('/hotels/' . $hotel->slug)
                ->assertSeeIn('.cls-contain-comment h3', 'Comment ( 1 )')
                ->assertSeeIn('.cls-contain-comment .col-md-12.comment-old .cls-username-comment', $user->username)
                ->press('.cls-contain-comment .col-md-12.comment-old a')
                ->assertSee('Do you want to update comment?')
                ->type('comment', '')
                ->press('SUBMIT')
                ->assertSee('The comment field is required.')
                ->assertPathIs('/hotels/' . $hotel->slug);
        });
    }

    /**
     * Test Error 404 Page.
     *
     * @return void
     */
    public function testNotFoundComment()
    {
        $hotel = $this->makeData();
        $user = $this->makeUser();
        $comment = $this->makeComment(1, 1);
        $this->browse(function (Browser $browser) use ($hotel, $user, $comment) {
            $browser->logout();
            $browser->loginAs($user)
                ->visit('/hotels/' . $hotel->slug)
                ->assertSeeIn('.cls-contain-comment h3', 'Comment ( 1 )')
                ->assertSeeIn('.cls-contain-comment .col-md-12.comment-old .cls-username-comment', $user->username);
            $comment->delete();
            $this->assertSoftDeleted('rating_comments', ['id'=>'1']);
            $browser->press('.cls-contain-comment .col-md-12.comment-old a')
                    ->assertInputValueIsNot('total_rating', $comment->total_rating)
                    ->assertInputValueIsNot('comment', $comment->comment);
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
        return Hotel::find(1);
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
        return User::find(1);
    }

    /**
     * Make comment of user had id = idUser for hotel has id = idHotel.
     *
     * @return void
     */
    public function makeComment($idUser, $idHotel)
    {   
        factory(RatingComment::class)->create([
            'hotel_id' => $idHotel,
            'user_id' => $idUser,
            'food' => 4,
            'cleanliness' => 4,
            'comfort' => 4,
            'location' => 4,
            'service' => 4,
            'total_rating' => 4,
            'comment' => 'bad for me!'
        ]);
        return RatingComment::find(1);
    }
}
