<?php

namespace Corals\Modules\Quality\Providers;

use Corals\Foundation\Providers\BaseInstallModuleServiceProvider;
use Corals\Modules\Quality\database\migrations\QualityTables;
use Corals\Modules\Quality\database\seeds\QualityDatabaseSeeder;

class InstallModuleServiceProvider extends BaseInstallModuleServiceProvider
{
    protected $module_public_path = __DIR__ . '/../public';
    
    protected $migrations = [
        QualityTables::class
    ];

    protected function providerBooted()
    {
        $this->createSchema();

        $qualityDatabaseSeeder = new QualityDatabaseSeeder();

        $qualityDatabaseSeeder->run();
    }
}
