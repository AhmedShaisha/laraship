<?php

namespace Corals\Modules\Support\database\seeds;

use Corals\Menu\Models\Menu;
use Corals\Settings\Models\Setting;
use Corals\User\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\MediaLibrary\Models\Media;

class SupportDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SupportPermissionsDatabaseSeeder::class);
        $this->call(SupportMenuDatabaseSeeder::class);
        $this->call(SupportSettingsDatabaseSeeder::class);
    }

    public function rollback()
    {
        Permission::where('name', 'like', 'Support::%')->delete();

        Menu::where('key', 'support')
            ->orWhere('active_menu_url', 'like', 'supports%')
            ->orWhere('url', 'like', 'supports%')
            ->delete();

        Setting::where('category', 'Support')->delete();

        Media::whereIn('collection_name', ['support-media-collection'])->delete();
    }
}
