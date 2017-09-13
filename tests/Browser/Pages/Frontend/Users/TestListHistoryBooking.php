<?php

namespace Tests\Browser\Pages\Frontend\Users;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\DB;
use App\Model\Room;
use App\Model\Reservation;
use App\Model\Hotel;
use App\Model\Place;
use App\Model\Guest;
use App\Model\User;
use Faker\Factory as Faker;

class TestListHistoryBooking extends DuskTestCase
{   
    use DatabaseMigrations;

    /**
     * A Test list history booking of user.
     *
     * @return void
     */
    public function testListBooking()
    {   
        $this->makeData(10);
        $this->browse(function (Browser $browser) {
            $browser->logout();
            $user = User::find(2);
            $browser->loginAs($user)
                    ->visit('/profile/2')
                    ->click('.table-user-information tbody tr:nth-child(5) td:nth-child(2) a')
                    ->assertVisible('#table-reservation')
                    ->assertSee('List Reservations')
                    ->assertPathIs('/profile/'.$user->id);
            $elements = $browser->elements('#table-reservation tbody tr');
            $numAccounts = count($elements);
            $this->assertTrue($numAccounts == 10 && $browser->text('.table-user-information tbody tr:nth-child(5) td:nth-child(2)') == $user->reservations->count());
            $browser->assertMissing('.pagination');         
        });
    }

    /**
     * Test if DataBase has 0 record .
     *
     * @return void
     */
    public function testHasZeroRecordListBooking()
    {   
        $this->makeData(10);
        DB::table('reservations')->truncate();
        $this->browse(function (Browser $browser) {
            $browser->logout();
            $user = User::find(2);
            $browser->loginAs($user)
                    ->visit('/profile/2')
                    ->click('.table-user-information tbody tr:nth-child(5) td:nth-child(2) a')
                    ->assertVisible('#table-reservation')
                    ->assertSee('List Reservations')
                    ->assertPathIs('/profile/'.$user->id);
            $elements = $browser->elements('#table-reservation tbody tr');
            $numAccounts = count($elements);
            $this->assertTrue($numAccounts == 0 && $browser->text('.table-user-information tbody tr:nth-child(5) td:nth-child(2)') == $user->reservations->count());
            $browser->assertMissing('.pagination');         
        });
    }

    /**
     * Test if database has > 10 record.
     *
     * @return void
     */
    public function testHasMoreRecordListBooking()
    {   
        $this->makeData(15);
        $this->browse(function (Browser $browser) {
            $browser->logout();
            $user = User::find(2);
            $browser->loginAs($user)
                    ->visit('/profile/2')
                    ->click('.table-user-information tbody tr:nth-child(5) td:nth-child(2) a')
                    ->assertVisible('#table-reservation')
                    ->assertSee('List Reservations')
                    ->assertPathIs('/profile/'.$user->id);
            $this->assertTrue($browser->text('.table-user-information tbody tr:nth-child(5) td:nth-child(2)') == $user->reservations->count());
            $elements = $browser->elements('#table-reservation tbody tr');
            $numAccounts = count($elements);
            $this->assertTrue($numAccounts == 10);
            $elements = $browser->click('.pagination li:nth-child(3) a')
                                ->click('.table-user-information tbody tr:nth-child(5) td:nth-child(2) a')
                                ->elements('#table-reservation tbody tr');
            $numAccounts = count($elements);
            $this->assertTrue($numAccounts == 5);
            $browser->assertPathIs('/profile/'.$user->id)
                    ->assertQueryStringHas('page', '2');    
        });
    }

    /**
     * Make data for test.  
     *
     * @return void
     */
    public function makeData($row)
    {   
        factory(Place::class, $row)->create();
        factory(User::class, 1)->create([
            'username' => 'user1',
            'password' => bcrypt('user1'),
            'is_active' => 1,
            'is_admin' => 0,
            'full_name' => 'User1'
            ]);
        factory(Guest::class, $row)->create();
        $placeIds = Place::all('id')->pluck('id')->toArray();
        $faker = Faker::create();
        for ($i = 0; $i < $row; $i++) {
            factory(Hotel::class, 1)->create([
                'place_id' => $faker->randomElement($placeIds)
            ]);
        }
        $hotelIds = Hotel::all('id')->pluck('id')->toArray();
        $faker = Faker::create();
        for ($i = 0; $i < $row; $i++) {
            factory(Room::class, 1)->create([
                'hotel_id' => $faker->randomElement($hotelIds),
            ]);
        }
        $roomIds = Room::all('id')->pluck('id')->toArray();
        $faker = Faker::create();
        for ($i = 0; $i < $row; $i++) {
            factory(Reservation::class, 1)->create([
                'room_id' => $faker->randomElement($roomIds),
                'target' => 'user',
                'target_id' => 2
            ]);
        }
    }
}
