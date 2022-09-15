<?php

namespace dnj\Currency\Tests;

use dnj\Currency\CurrencyServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;

    protected function getPackageProviders($app)
    {
        return [
            CurrencyServiceProvider::class,
        ];
    }
}
