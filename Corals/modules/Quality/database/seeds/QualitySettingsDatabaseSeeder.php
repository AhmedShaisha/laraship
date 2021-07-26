<?php

namespace Corals\Modules\Quality\database\seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class QualitySettingsDatabaseSeeder extends Seeder
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
                'code' => 'quality_setting',
                'type' => 'TEXT',
                'category' => 'Quality',
                'label' => 'Quality setting',
                'value' => 'quality',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            //add addressshipping in general sittings
            [
                'code' => 'warehouse_address',
                'type' => 'TEXTAREA',
                'category' => 'General',
                'label' => 'Warehouse Address',
                'value' => 'shipping addrress ...',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
