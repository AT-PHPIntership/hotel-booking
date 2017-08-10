<?php
namespace Tests\Browser\Pages\Backend\Users;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Model\User;

class ListUserTest extends DuskTestCase
{
    use DatabaseTransactions;

     /**
     * A Dusk test route to page.
     *
     * @return void
     */
    public function testClickRoute()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin')
                    ->clickLink(__('Users'))
                    ->assertPathIs('/admin/user')
                    ->assertSee('List User')
                    ->screenshot(1);
        });
    }

     /**
     * A Dusk test show record with table empty.
     *
     * @return void
     */
    public function testShowEmpty()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/user')
                    ->assertPathIs('/admin/user')
                    ->assertSee('List User');
            $elements = $browser->elements('#table-contain tbody tr');
            $row = count($elements);
            $this->assertTrue($row == 0);
            $this->assertNull($browser->element('.pagination'));
        });
    }

     /**
     * A Dusk test show record with table has data.
     *
     * @return void
     */
    public function testShowRecord()
    {
        factory(User::class, 9)->create();
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/user')
                    ->resize(1920, 2000)
                    ->assertPathIs('/admin/user')
                    ->assertSee('List User');
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
        factory(User::class, 11)->create();
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/user')
                    ->resize(1920, 2000)
                    ->assertPathIs('/admin/user')
                    ->assertSee('List User');
            $elements = $browser->elements('#table-contain tbody tr');
            $row = count($elements);
            $this->assertTrue($row == 10);
            $this->assertNotNull($browser->element('.pagination'));
        });
    }
}