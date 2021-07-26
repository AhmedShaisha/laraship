<?php

namespace Corals\Modules\Approval\database\seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ApprovalPermissionsDatabaseSeeder extends Seeder
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
                'name' => 'approvalofficer',
                'label' => 'Approval Officer',
                'guard_name' => config('auth.defaults.guard'),
                'subscription_required' => 0,
                'dashboard_theme' => 'corals-marketplace-master',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            ]); 
            //end added 
        \DB::table('permissions')->insert([
            [
                'name' => 'Approval::approveRequest.view',
                'guard_name' => config('auth.defaults.guard'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Approval::approveRequest.create',
                'guard_name' => config('auth.defaults.guard'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Approval::approveRequest.update',
                'guard_name' => config('auth.defaults.guard'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Approval::approveRequest.delete',
                'guard_name' => config('auth.defaults.guard'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
                       [
                                'name' => 'Administrations::admin.approval',
                                'guard_name' => config('auth.defaults.guard'),
                               'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ],
        ]);
    }
}
