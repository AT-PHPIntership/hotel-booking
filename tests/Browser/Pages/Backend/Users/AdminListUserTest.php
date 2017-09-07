<?php
namespace Tests\Browser\Pages\Backend\Users;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\User;

class AdminListUserTest extends DuskTestCase
{
    use DatabaseMigrations;

     /**
     * A Dusk test route to page list users.
     *
     * @return void
     */
    public function testClickRoute()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin')
                    ->clickLink('Users')
                    ->assertPathIs('/admin/user')
                    ->assertSee('List Users');
        });
    }

     /**
     * A Dusk test show record with table has data.
     *
     * @return void
     */
    public function testShowRecord()
    {
        factory(User::class, 8)->create();
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/user')
                    ->resize(1920, 2000)
                    ->assertPathIs('/admin/user')
                    ->assertSee('List Users');
            $elements = $browser->elements('#table-contain tbody tr');
            $row = count($elements);
            $this->assertTrue($row == 9);
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
        factory(User::class, 10)->create();
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/user')
                    ->resize(1920, 2000)
                    ->assertPathIs('/admin/user')
                    ->assertSee('List Users');
            $elements = $browser->elements('#table-contain tbody tr');
            $row = count($elements);
            $this->assertTrue($row == 10);
            $this->assertNotNull($browser->element('.pagination'));
        });
    }

    /**
     * Test click page 2 in pagination link
     *
     * @return void
     */
    public function testPathPagination()
    {   
        factory(User::class, 11)->create();
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/user?page=2');
            $elements = $browser->elements('#table-contain tbody tr');
            $this->assertCount(2, $elements);
            $browser->assertPathIs('/admin/user');
            $browser->assertQueryStringHas('page', 2);
        });
    }
}