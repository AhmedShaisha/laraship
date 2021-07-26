<?php

namespace Corals\Modules\Support\database\seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SupportSettingsDatabaseSeeder extends Seeder
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
                'code' => 'support_setting',
                'type' => 'TEXT',
                'category' => 'Support',
                'label' => 'Support setting',
                'value' => 'support',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
