<?php

namespace Tests;

use Laravel\BrowserKitTesting\TestCase as BaseTestCase;

abstract class BrowserKitTesting extends BaseTestCase
{
    use CreatesApplication;

    public $baseUrl = 'http://localhost';

    // ...
}