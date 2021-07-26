<?php

namespace Corals\Modules\Quality\Providers;

use Corals\Foundation\Providers\BaseUninstallModuleServiceProvider;
use Corals\Modules\Quality\database\migrations\QualityTables;
use Corals\Modules\Quality\database\seeds\QualityDatabaseSeeder;


class UninstallModuleServiceProvider extends BaseUninstallModuleServiceProvider
{
    protected $migrations = [
        QualityTables::class
    ];

    protected function providerBooted()
    {
        $this->dropSchema();

        $qualityDatabaseSeeder = new QualityDatabaseSeeder();
        
        $qualityDatabaseSeeder->rollback();
    }
}
