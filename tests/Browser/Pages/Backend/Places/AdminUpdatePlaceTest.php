<?php

namespace Tests\Browser\Pages\Backend\Places;

use App\Model\Place;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\UploadedFile;

class AdminUpdatePlaceTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        Place::create([
            'name' => 'Da Nang',
            'descript' => 'City of Viet Nam',
            'image' => 'image.jpg',
         ]);
    }

    /**
     * Test value for each input in edit form.
     *
     * @return void
     */
    public function testValueEditPlace()
    {
        $this->browse(function (Browser $browser)  {
            $place = Place::find(1);
            $page = $browser->visit('/admin/place')
                ->press('#table-contain tbody tr:nth-child(1) td:nth-child(4) a');
            $page->assertPathIs('/admin/place/' . $place->id . '/edit')
                ->assertSee('Update place')
                ->assertInputValue('name', $place->name)
                ->assertInputValue('descript', $place->descript);
            $element = $page->element('#showImage');
            $imageSrc = $element->getAttribute('src');
            $imageName = explode('/', $imageSrc);
            $this->assertTrue($imageName[5] === $place->image);    
        });
    }

    /**
     * Cases of test value image
     *
     * @return array
     */
    public function listCaseTestValueImage()
    {   
        $image = $this->fakeImage();
        return [
            [$image],
            ['']
        ];
    }

    /**
     * Test admin update place success.
     *
     * @dataProvider listCaseTestValueImage
     *
     * @return void
     */
    public function testUpdatesPlaceSuccess($image)
    {
        $this->browse(function (Browser $browser) use ($image) {
            $place = Place::find(1);
            $page = $browser->visit('/admin/place')
                ->press('#table-contain tbody tr:nth-child(1) td:nth-child(4) a');
            $page->assertPathIs('/admin/place/' . $place->id . '/edit')
                ->assertSee('Update place')
                ->type('name', 'Ha Noi');
            $this->typeInCKEditor($browser, '#cke_place-descript iframe', 'Capital of Viet Nam');
            $page->attach('image', $image)
                ->press('Submit')
                ->assertPathIs('/admin/place')
                ->assertSee('Update success');

            $place_after_update = Place::find(1);
            $checkImage = ($image != '') ?
                $place_after_update->image != $place->image :
                $place_after_update->image == $place->image;
            $this->assertTrue($checkImage);

            $image_after_update = $image ? $place_after_update->image : $place->image;
            $this->assertDatabaseHas('places', [
                'name' => 'Ha Noi',
                'image' => $image_after_update
            ]);
            $this->assertTrue(strip_tags($place_after_update->descript) == 'Capital of Viet Nam');
        });
        
    }

    /**
     * List case for test validation create place
     *
     */
    public function listCaseTestForUpdatePlace()
    {   
        $image = $this->fakeImage();
        $file = $this->fakeFile();
        return [
            ['', 'City of Viet Nam', $image, 'The name field is required.'],
            ['Ha Noi', '', $image, 'The descript field is required.'],
            ['Ha Noi', 'City of Viet Nam', $file, 'The image must be an image.'],
        ];
    }

    /**
     * Test update place fail
     *
     * @dataProvider listCaseTestForUpdatePlace
     * 
     * @param string $name place name
     * @param string $descript place descript
     * @param string $image place image
     * @param string $expected message warning
     * 
     */
    public function testUpdatePlaceFail($name, $descript, $image, $expected)
    {   
        
        $this->browse(function (Browser $browser) use ($name, $descript, $image, $expected) {
            $place = Place::find(1);
            $page = $browser->visit('/admin/place')
                ->press('#table-contain tbody tr:nth-child(1) td:nth-child(4) a')
                ->assertPathIs('/admin/place/' . $place->id . '/edit')
                ->assertSee('Update place')
                ->type('name', $name)
                ->attach('image',  $image);
            $this->typeInCKEditor($browser, '#cke_place-descript iframe', $descript);
            $page->press('Submit')
                ->assertSee($expected)
                ->assertPathIs('/admin/place/' . $place->id . '/edit');
        });
    }

    /**
     * Test 404 Page Not found when click edit place from list place.
     *
     * @return void
     */
    public function test404PageForClickEdit()
    {   
        $place = Place::find(1);
        $this->browse(function (Browser $browser) use ($place) {
            $browser->visit('/admin/place')->assertSee('List place');
            $place->delete();
            $browser->press('#table-contain tbody tr:nth-child(1) td:nth-child(4) a');
            $browser->assertSee('404 - Page Not found');
        });
    }

    /**
     * Test 404 Page Not found when click submit edit place.
     *
     * @return void
     */
    public function test404PageForClickSubmit()
    {   
        $place = Place::find(1);
        $this->browse(function (Browser $browser) use ($place) {
            $browser->visit('/admin/place')
                ->assertSee('List place')
                ->press('#table-contain tbody tr:nth-child(1) td:nth-child(4) a')
                ->assertPathIs('/admin/place/'.$place->id.'/edit')
                ->assertSee('Update place')
                ->type('name', 'Ha Long');
            $this->typeInCKEditor($browser, '#cke_place-descript iframe', 'Quang Ninh');
            $place->delete();
            $browser->press('Submit')->assertSee('404 - Page Not found');
        });
    }

    /**
     * Fake image place
     * 
     * @return string
     */
    public static function fakeImage()
    {    
        $image = UploadedFile::fake()->image('image_test.jpg');
        return $image;
    } 

    /**
     * Fake file to test upload image invalid image type
     * 
     * @return string
     */
    public static function fakeFile()
    {   
        $file = UploadedFile::fake()->create('file_test.php', 2000);
        return $file;
    }
}
