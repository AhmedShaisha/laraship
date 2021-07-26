<?php

namespace Corals\Modules\Approval\Providers;

use Corals\Foundation\Providers\BaseUninstallModuleServiceProvider;
use Corals\Modules\Approval\database\migrations\ApprovalTables;
use Corals\Modules\Approval\database\migrations\AddAdminApprovedToMarketplaceProducts;
use Corals\Modules\Approval\database\migrations\AddIsInfluencerStore;
use Corals\Modules\Approval\database\seeds\ApprovalDatabaseSeeder;

class UninstallModuleServiceProvider extends BaseUninstallModuleServiceProvider
{
    protected $migrations = [
        ApprovalTables::class,
        AddAdminApprovedToMarketplaceProducts::class,
        AddIsInfluencerStore::class,
    ];

    protected function providerBooted()
    {
        $this->dropSchema();

        $approvalDatabaseSeeder = new ApprovalDatabaseSeeder();
        
        $approvalDatabaseSeeder->rollback();
    }
}
