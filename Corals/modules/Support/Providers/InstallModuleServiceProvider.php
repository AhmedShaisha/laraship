<?php

namespace Corals\Modules\Support\Providers;

use Corals\Foundation\Providers\BaseInstallModuleServiceProvider;
use Corals\Modules\Support\database\migrations\SupportTables;
use Corals\Modules\Support\database\seeds\SupportDatabaseSeeder;
use Corals\Modules\Support\database\migrations\CustomerSupportResponsesTable;
class InstallModuleServiceProvider extends BaseInstallModuleServiceProvider
{
    protected $module_public_path = __DIR__ . '/../public';
    
    protected $migrations = [
        SupportTables::class,
        CustomerSupportResponsesTable::class
    ];

    protected function booted()
    {
        $this->createSchema();

        $supportDatabaseSeeder = new SupportDatabaseSeeder();

        $supportDatabaseSeeder->run();
    }
}
