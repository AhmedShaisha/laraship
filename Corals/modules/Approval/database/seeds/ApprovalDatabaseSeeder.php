<?php

namespace Corals\Modules\Approval\database\seeds;

use Corals\Menu\Models\Menu;
use Corals\Settings\Models\Setting;
use Corals\User\Models\Permission;
use Illuminate\Database\Seeder;
use \Spatie\MediaLibrary\MediaCollections\Models\Media;

class ApprovalDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ApprovalPermissionsDatabaseSeeder::class);
        $this->call(ApprovalMenuDatabaseSeeder::class);
        $this->call(ApprovalSettingsDatabaseSeeder::class);
         //added
         $this->call(ApprovalNotificationTemplatesSeeder::class);
    }

    public function rollback()
    {
        Permission::where('name', 'like', 'Approval::%')->delete();

        Menu::where('key', 'approval')
            ->orWhere('active_menu_url', 'like', 'approvals%')
            ->orWhere('url', 'like', 'approvals%')
            ->delete();

        Setting::where('category', 'Approval')->delete();

        Media::whereIn('collection_name', ['approval-media-collection'])->delete();
    }
}
