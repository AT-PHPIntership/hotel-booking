<?php
namespace Tests\Browser;

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
     * A Dusk test show content.
     *
     * @return void
     */
    public function testContent()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/user')
                    ->assertSee('List User');
        });
    }

    /**
     * A Dusk test status code.
     *
     * @return void
     */
    public function testApplication()
    {
        $response = $this->call('GET', '/admin/user');
        $this->assertEquals(200, $response->status());
    }

     /**
     * A Dusk test route to page.
     *
     * @return void
     */
    public function testClickRoute()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin')
                    ->click('#link-user')
                    ->assertPathIs('/admin/user')
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
                    ->assertSee('List User');
            $elements = $browser->elements('#table-contain tbody tr');
            $row = count($elements);
            $this->assertTrue($row == 0);
        });
    }

     /**
     * A Dusk test show record with table has data.
     *
     * @return void
     */
    public function testShowRecord()
    {
        factory(User::class, User::ROW_LIMIT - 1)->create();
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/user')
                    ->resize(1920, 2000)
                    ->assertSee('List User');
            $elements = $browser->elements('#table-contain tbody tr');
            $row = count($elements);
            $this->assertTrue($row == User::ROW_LIMIT - 1);
        });
    }
    /**
     * A Dusk test show record with table has data and ensure pagnate.
     *
     * @return void
     */
    public function testShowRecordPagnate()
    {
        factory(User::class, User::ROW_LIMIT + 1)->create();
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/user')
                    ->resize(1920, 2000)
                    ->assertSee('List User');
            $elements = $browser->elements('#table-contain tbody tr');
            $row = count($elements);
            $this->assertTrue($row == User::ROW_LIMIT);
        });
    }
}