<?php

namespace Corals\Modules\Quality\database\seeds;

use Illuminate\Database\Seeder;
use Corals\User\Models\Role;
class QualityMenuDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $qualitymanager_role = Role::where('name', 'qualitymanager')->first();
        $qualitymanager_role_id = $qualitymanager_role->id;

        $qualityassistant_role = Role::where('name', 'qualityassistant')->first();
        $qualityassistant_role_id = $qualityassistant_role->id;

        $quality_menu_id = \DB::table('menus')->insertGetId([
            'parent_id' => 1,// admin
            'key' => 'quality',
            'url' => null,
            'active_menu_url' => 'qualityTests*',
            'name' => 'Quality',
            'description' => 'Quality Menu Item',
            'icon' => 'fa fa-globe',
            'target' => null, 'roles' => '["1","'.$qualitymanager_role_id.'","'.$qualityassistant_role_id.'"]',
            'order' => 0
        ]);

        // seed children menu
        \DB::table('menus')->insert([
                [
                    'parent_id' => $quality_menu_id,
                    'key' => null,
                    'url' => config('quality.models.qualityTest.resource_url'),
                    'active_menu_url' => config('quality.models.qualityTest.resource_url') . '*',
                    'name' => 'QualityTests',
                    'description' => 'QualityTests List Menu Item',
                    'icon' => 'fa fa-cube',
                    'target' => null, 'roles' => '["1","'.$qualitymanager_role_id.'","'.$qualityassistant_role_id.'"]',
                    'order' => 0
                ],
                [
                    'parent_id' => $quality_menu_id,
                    'key' => null,
                    'url' => 'qualityTests/settings',
                    'active_menu_url' => 'qualityTests/settings',
                    'name' => 'Settings',
                    'description' => 'Settings Menu Item',
                    'icon' => 'fa fa-cog',
                    'target' => null, 'roles' => '["1","'.$qualitymanager_role_id.'"]',
                    'order' => 0
                ],
            ]
        );
    }
}
