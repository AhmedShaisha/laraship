<?php

namespace Corals\Modules\Approval\Providers;

use Corals\Foundation\Providers\BaseInstallModuleServiceProvider;
use Corals\Modules\Approval\database\migrations\ApprovalTables;
use Corals\Modules\Approval\database\migrations\AddAdminApprovedToMarketplaceProducts;
use Corals\Modules\Approval\database\migrations\AddIsInfluencerStore;
use Corals\Modules\Approval\database\seeds\ApprovalDatabaseSeeder;

class InstallModuleServiceProvider extends BaseInstallModuleServiceProvider
{
    protected $module_public_path = __DIR__ . '/../public';
    
    protected $migrations = [
        ApprovalTables::class,
        AddAdminApprovedToMarketplaceProducts::class,
        AddIsInfluencerStore::class,
    ];

    protected function providerBooted()
    {
        $this->createSchema();

        $approvalDatabaseSeeder = new ApprovalDatabaseSeeder();

        $approvalDatabaseSeeder->run();
    }
}
