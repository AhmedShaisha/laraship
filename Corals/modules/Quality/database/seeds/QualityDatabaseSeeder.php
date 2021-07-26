<?php

namespace Corals\Modules\Quality\database\seeds;

use Corals\Menu\Models\Menu;
use Corals\Settings\Models\Setting;
use Corals\User\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Corals\User\Models\Role;  
class QualityDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(QualityPermissionsDatabaseSeeder::class);
        $this->call(QualityMenuDatabaseSeeder::class);
        $this->call(QualitySettingsDatabaseSeeder::class);
        //added 
        $this->call(QualityNotificationTemplatesSeeder::class);
    }

    public function rollback()
    {
        Permission::where('name', 'like', 'Quality::%')->delete();

        Menu::where('key', 'quality')
            ->orWhere('active_menu_url', 'like', 'qualitys%')
            ->orWhere('url', 'like', 'qualitys%')
            ->delete();

        Setting::where('category', 'Quality')->delete();

        Media::whereIn('collection_name', ['quality-media-collection'])->delete();
        //added
        Role::whereName('qualitymanager')->delete();
        Role::whereName('qualityassistant')->delete();
    }
}
