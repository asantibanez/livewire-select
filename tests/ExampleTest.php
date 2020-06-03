<?php

namespace Asantibanez\LivewireSelect\Tests;

use Orchestra\Testbench\TestCase;
use Asantibanez\LivewireSelect\LivewireSelectServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [LivewireSelectServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
