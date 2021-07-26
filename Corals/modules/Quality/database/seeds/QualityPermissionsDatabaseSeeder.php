<?php

namespace Corals\Modules\Quality\database\seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Corals\User\Models\Role;

class QualityPermissionsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //added 
        \DB::table('roles')->insert([
            [
                'name' => 'qualitymanager',
                'label' => 'Quality Manager',
                'guard_name' => config('auth.defaults.guard'),
                'subscription_required' => 0,
                'dashboard_theme' => 'corals-marketplace-master',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'qualityassistant',
                'label' => 'Quality Assistant',
                'guard_name' => config('auth.defaults.guard'),
                'subscription_required' => 0,
                'dashboard_theme' => 'corals-marketplace-master',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
           
        ]); 
        //end
        \DB::table('permissions')->insert([
            [
                'name' => 'Quality::qualityTest.view',
                'guard_name' => config('auth.defaults.guard'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Quality::settings.access',
                'guard_name' => config('auth.defaults.guard'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Quality::qualityTest.create',
                'guard_name' => config('auth.defaults.guard'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Quality::qualityTest.update',
                'guard_name' => config('auth.defaults.guard'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Quality::qualityTest.delete',
                'guard_name' => config('auth.defaults.guard'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [

                'name' => 'Administrations::admin.quality',
                'guard_name' => config('auth.defaults.guard'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ],

        ]);
        //added
        $qualitymanager_role = Role::where('name', 'qualitymanager')->first();

        if ($qualitymanager_role) {
            
            $qualitymanager_role->forgetCachedPermissions();
            $qualitymanager_role->givePermissionTo('Quality::qualityTest.update');
            $qualitymanager_role->givePermissionTo('Quality::qualityTest.view');
            $qualitymanager_role->givePermissionTo('Quality::qualityTest.delete');
            $qualitymanager_role->givePermissionTo('Quality::settings.access');
         
        }
        
        $qualityassistant_role = Role::where('name', 'qualityassistant')->first();

        if ($qualityassistant_role) {
            
            $qualityassistant_role->forgetCachedPermissions();
            $qualityassistant_role->givePermissionTo('Quality::qualityTest.update');
            $qualityassistant_role->givePermissionTo('Quality::qualityTest.view');
                     
        }

    }
}
