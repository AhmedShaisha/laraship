<?php

namespace Corals\Modules\Support\database\seeds;

use Illuminate\Database\Seeder;

class SupportMenuDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $support_menu_id = \DB::table('menus')->insertGetId([
            'parent_id' => 1,// admin
            'key' => 'support',
            'url' => null,
            'active_menu_url' => 'customerSupports*',
            'name' => 'Support',
            'description' => 'Support Menu Item',
            'icon' => 'fa fa-globe',
            'target' => null, 'roles' => '["1","2"]',
            'order' => 0
        ]);

        // seed children menu
        \DB::table('menus')->insert([
                [
                    'parent_id' => $support_menu_id,
                    'key' => null,
                    'url' => config('support.models.customerSupport.resource_url'),
                    'active_menu_url' => config('support.models.customerSupport.resource_url') . '*',
                    'name' => 'Customer Supports',
                    'description' => 'CustomerSupports List Menu Item',
                    'icon' => 'fa fa-cube',
                    'target' => null, 'roles' => '["1"]',
                    'order' => 0
                ],
            ]
        );
    }
}
