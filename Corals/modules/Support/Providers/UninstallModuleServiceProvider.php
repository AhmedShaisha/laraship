<?php

namespace Corals\Modules\Support\Providers;

use Corals\Foundation\Providers\BaseUninstallModuleServiceProvider;
use Corals\Modules\Support\database\migrations\SupportTables;
use Corals\Modules\Support\database\seeds\SupportDatabaseSeeder;
use Corals\Modules\Support\database\migrations\CustomerSupportResponsesTable;

class UninstallModuleServiceProvider extends BaseUninstallModuleServiceProvider
{
    protected $migrations = [
        SupportTables::class,
        CustomerSupportResponsesTable::class
    ];

    protected function booted()
    {
        $this->dropSchema();

        $supportDatabaseSeeder = new SupportDatabaseSeeder();
        
        $supportDatabaseSeeder->rollback();
    }
}
