<?php


namespace INBRAIN\OMP\Console;


use Illuminate\Console\Command;

class InstallMiddlewarePackage extends Command
{
    protected $signature = 'serverMiddleware:install';

    protected $description = 'Install the Server2Server Middleware';

    public function handle()
    {

        $this->info('Installing Server2Server Middleware...');

        $this->info('Publishing configuration...');

        $this->call('vendor:publish', [
            '--provider' => "INBRAIN\OMP\Providers\AuthMiddlewareServiceProvider",
        ]);

        $this->info('Installed Server2Server Middleware');
    }
}
