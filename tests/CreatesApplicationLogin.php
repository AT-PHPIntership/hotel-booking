<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Facebook\WebDriver\WebDriverBy;

trait CreatesApplicationLogin
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    public function tearDown()
    {
        $this->beforeApplicationDestroyed(function () {
            \DB::disconnect();
        });

        parent::tearDown();
    }

    /**
     * Type text to CKeditor
     *
     * @param  Browser $browser instance of Browser
     * @param  int $ckEditorId ckEditor ID
     * @param  string $text text in body ckEditor
     *
     * @return void
     */
    public function typeInCKEditor($browser, $ckEditorId, $text)
    {
        $frame = $browser->driver
            ->findElement(WebDriverBy::cssSelector($ckEditorId));
        $browser->driver->switchTo()->frame($frame);
        try {
            $body = $browser->driver
                ->findElement(WebDriverBy::className('cke_editable'));
            $body->click();
            $body->clear();
            $body->sendKeys($text);
        }
        catch(\Exception $e){
            echo $e->getMessage();
        }
        $browser->driver->switchTo()->defaultContent();
    }
}
