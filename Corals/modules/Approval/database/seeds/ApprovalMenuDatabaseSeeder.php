<?php

namespace Corals\Modules\Approval\database\seeds;

use Illuminate\Database\Seeder;

class ApprovalMenuDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $approval_menu_id = \DB::table('menus')->insertGetId([
            'parent_id' => 1,// admin
            'key' => 'approval',
            'url' => null,
            'active_menu_url' => 'approveRequests*',
            'name' => 'Approval',
            'description' => 'Approval Menu Item',
            'icon' => 'fa fa-globe',
            'target' => null, 'roles' => '["1","3"]',
            'order' => 0
        ]);

        // seed children menu
        \DB::table('menus')->insert([
                [
                    'parent_id' => $approval_menu_id,
                    'key' => null,
                    'url' => config('approval.models.approveRequest.resource_url'),
                    'active_menu_url' => config('approval.models.approveRequest.resource_url') . '*',
                    'name' => 'ApproveRequests',
                    'description' => 'ApproveRequests List Menu Item',
                    'icon' => 'fa fa-cube',
                    'target' => null, 'roles' => '["1","3"]',
                    'order' => 0
                ],
            ]
        );
    }
}
