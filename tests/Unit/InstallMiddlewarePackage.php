<?php

namespace INBRAIN\OMP\Tests\Unit;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use INBRAIN\OMP\Tests\TestCase;

class InstallMiddlewarePackage extends TestCase
{
    /** @test */
    function the_install_command_copies_a_the_configuration()
    {
        // make sure we're starting from a clean state
        if (File::exists(config_path('serverMiddleware.php'))) {
            unlink(config_path('serverMiddleware.php'));
        }

        $this->assertFalse(File::exists(config_path('serverMiddleware.php')));

        Artisan::call('serverMiddleware:install');

        $this->assertTrue(File::exists(config_path('serverMiddleware.php')));
    }
}