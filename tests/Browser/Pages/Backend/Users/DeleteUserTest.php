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

class DeleteUserTest extends DuskTestCase
{
    /**
     * Test success when click delete button.
     *
     * @return void
     */
    public function testDeleteSuccess()
    {
        $this->browse(function (Browser $browser) {
            factory(User::class, 1)->create();
            $browser->visit('/admin/user')
                    ->click('.btn-delete-item')
                    ->acceptDialog()
                    ->assertPathIs('/admin/user')
                    ->assertSee(__('Detetion successful!'))
                    ->screenshot(1);
            $elements = $browser->elements('#table-contain tbody tr');
            $row = count($elements);
            $this->assertTrue($row == 0);
        });
    }

    /**
     * Test fail because object not exist.
     *
     * @return void
     */
    public function testDeleteObjectNotExist()
    {
        $this->browse(function (Browser $browser) {
            factory(User::class, 1)->create();
            $browser->visit('/admin/user')
                    ->click('.btn-delete-item')
                    ->acceptDialog()
                    ->assertPathIs('/admin/user/id')
                    ->assertSee(__('Detetion successful!'))
                    ->screenshot(1);
            $elements = $browser->elements('#table-contain tbody tr');
            $row = count($elements);
            $this->assertTrue($row == 0);
        });
    }

    /**
     * Test fail because can't delete.
     *
     * @return void
     */
    public function testCanNotDelete()
    {
        $this->browse(function (Browser $browser) {
            factory(User::class, 1)->create();
            $browser->visit('/admin/user')
                    ->click('.btn-delete-item')
                    ->acceptDialog()
                    ->assertPathIs('/admin/user')
                    ->assertSee(__('Detetion failed!'))
                    ->screenshot(1);
            $elements = $browser->elements('#table-contain tbody tr');
            $row = count($elements);
            $this->assertTrue($row == 0);
        });
    }
}
