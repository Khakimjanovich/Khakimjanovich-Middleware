<?php

namespace INBRAIN\OMP\Providers;

use Illuminate\Support\ServiceProvider;
use INBRAIN\OMP\Console\InstallMiddlewarePackage;

class AuthMiddlewareServiceProvider extends ServiceProvider
{
    protected array $commands = [
        InstallMiddlewarePackage::class
    ];

    public function register(): void
    {
        $this->commands($this->commands);
        $this->mergeConfigFrom($this->configPath(), 'inbrain');
    }

    protected function configPath(): string
    {
        return __DIR__ . '/../../config/config.php';
    }

    public function boot(): void
    {
        $this->publishes([$this->configPath() => config_path('inbrain.php')], 'inbrain');

        if ($this->app->runningInConsole()) {


            if (!class_exists('AddFieldsToUsersTable')) {
                $this->publishes([
                    __DIR__ . '/../../database/migrations/add_fields_to_users_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_add_fields_to_users_table.php'),
                ], 'migrations');
            }
        }
    }
}
