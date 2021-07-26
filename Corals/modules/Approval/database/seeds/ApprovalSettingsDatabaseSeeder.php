<?php

namespace Corals\Modules\Approval\database\seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ApprovalSettingsDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('settings')->insert([
            [
                'code' => 'approval_setting',
                'type' => 'TEXT',
                'category' => 'Approval',
                'label' => 'Approval setting',
                'value' => 'approval',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
