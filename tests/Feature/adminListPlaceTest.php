<?php

namespace Tests\Feature;

use Tests\BrowserKitTesting as TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminListPlaceTest extends TestCase
{
    /**
     * Test visit page admin place
     *
     * @test
     *
     * @return void
     */
    public function visitAdminListPlace()
    {
        $this->visit('/admin/place')
            ->see('List Place');
    }
    
    /**
     * Test route admin place
     *
     * @test
     *
     * @return void
     */
    public function pressAddPlaceButton()
    {
        $this->visit('admin/place')
            ->press('Add place')
            ->see('admin/place/create');
    }
}
