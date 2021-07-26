<?php

namespace Corals\Settings\database\seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    public function run()
    {
        \DB::table('settings')->delete();

        $this->call(SettingsPermissionsTableSeeder::class);
        $this->call(CountriesTableSeeder::class);

        \DB::table('settings')->insert([
            [
                'code' => 'site_name',
                'type' => 'TEXT',
                'category' => 'General',
                'label' => 'Site Name',
                'value' => 'Corals',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'super_user_id',
                'type' => 'NUMBER',
                'category' => 'General',
                'label' => 'Super user id',
                'value' => 1,
                'editable' => 0,
                'hidden' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'super_user_role_id',
                'type' => 'NUMBER',
                'category' => 'General',
                'label' => 'Super user role id',
                'value' => 1,
                'editable' => 0,
                'hidden' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'default_user_role',
                'type' => 'TEXT',
                'category' => 'User',
                'label' => 'Default User Role',
                'value' => 'member',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'social_links',
                'type' => 'SELECT',
                'category' => 'General',
                'label' => 'Social Links',
                'value' => '{"facebook":"https:\/\/www.facebook.com\/coralslaraship","twitter":"https:\/\/twitter.com\/corals_laraship","linkedin":"https:\/\/www.linkedin.com\/","instagram":"https:\/\/www.instagram.com\/","pinterest":"https:\/\/www.pinterest.com\/"}',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'code' => 'twitter_id',
                'type' => 'TEXT',
                'category' => 'General',
                'label' => 'twitter_id',
                'value' => 'corals_laraship',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'footer_text',
                'type' => 'TEXTAREA',
                'category' => 'General',
                'label' => 'Footer Text',
                'value' => '&copy; 2020 <a target="_blank" href="http://corals.io/"
                               title="Corals.io">Corals.io</a>.
                All Rights Reserved.',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'terms_and_policy',
                'type' => 'TEXTAREA',
                'category' => 'General',
                'label' => 'Terms and Policy Text',
                'value' => '<p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis iaculis ante eget urna tincidunt, sed tristique velit fermentum. Vivamus viverra urna sed quam semper feugiat. Mauris accumsan imperdiet metus, vitae porttitor mi egestas sit amet. Duis a nibh quam. Sed sit amet purus fringilla, auctor tellus et, consectetur libero. Nullam non orci tristique, sollicitudin magna sed, convallis est. Aenean fermentum arcu aliquet purus placerat, ut aliquam libero commodo. Pellentesque tortor purus, gravida rhoncus porttitor in, pulvinar eu mi. Sed vitae consectetur justo.
</p>
<p>
Aliquam aliquam, elit ac malesuada blandit, nulla ligula posuere nisl, non mattis arcu eros et enim. Proin dapibus erat sit amet egestas egestas. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Duis vulputate tortor a massa porttitor, sit amet posuere mi pharetra. Cras efficitur lobortis condimentum. Vivamus dapibus cursus eros bibendum finibus. Donec rhoncus libero a sem volutpat, ut mattis orci sollicitudin. Pellentesque malesuada metus quis ullamcorper vestibulum. Aenean erat dui, elementum finibus ligula vitae, feugiat placerat tellus. Cras placerat in dolor in iaculis. Suspendisse tempor gravida vehicula. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi odio urna, lobortis sed euismod eget, semper sed lorem.
</p>',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'site_logo',
                'type' => 'FILE',
                'category' => 'General',
                'label' => 'Site Logo',
                'value' => 'site_logo.png',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'site_logo_white',
                'type' => 'FILE',
                'category' => 'General',
                'label' => 'Site White Logo',
                'value' => 'site_logo_white.png',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'site_favicon',
                'type' => 'FILE',
                'category' => 'General',
                'label' => 'Site favicon',
                'value' => 'site_favicon.png',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'login_background',
                'type' => 'TEXTAREA',
                'category' => 'General',
                'label' => 'Login Background',
                'value' => 'background: url(/media/demo/login_backgrounds/login_background.png);
background-repeat: repeat-y;
background-size: 100% auto;
background-position: center top;
background-attachment: fixed;',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'google_map_url',
                'type' => 'TEXT',
                'category' => 'General',
                'label' => 'Google Map URL',
                'value' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3387.331591494841!2d35.19981536504809!3d31.897586781246385!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x518201279a8595!2sLeaders!5e0!3m2!1sen!2s!4v1512481232226',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'contact_form_email',
                'type' => 'TEXT',
                'category' => 'General',
                'label' => 'Contact Email',
                'value' => 'support@example.com',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'contact_address',
                'type' => 'TEXTAREA',
                'category' => 'General',
                'label' => 'Contact Address',
                'value' => 'Leaders Organization 2nd Floor,Adel Masri Bldg – Al-Masyoun, Ramallah, Palestine.',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'contact_mobile',
                'type' => 'TEXT',
                'category' => 'General',
                'label' => 'Contact Mobile',
                'value' => '+970599593301',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'google_analytics_id',
                'type' => 'TEXT',
                'category' => 'General',
                'label' => 'Google Analytics Id',
                'value' => 'UA-76211720-1',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'google_tag_manager_id',
                'type' => 'TEXT',
                'category' => 'General',
                'label' => 'Google Tag Manager Id',
                'value' => 'GTM-M78BQH6',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],


            [
                'code' => 'active_admin_theme',
                'type' => 'TEXT',
                'category' => 'Theme',
                'label' => 'Active admin theme',
                'value' => 'corals-admin',
                'editable' => 1,
                'hidden' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'active_frontend_theme',
                'type' => 'TEXT',
                'category' => 'Theme',
                'label' => 'Active frontend theme',
                'value' => 'corals-basic',
                'editable' => 1,
                'hidden' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'two_factor_auth_enabled',
                'type' => 'BOOLEAN',
                'category' => 'User',
                'label' => 'Two factor auth enabled?',
                'value' => 'false',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'two_factor_auth_provider',
                'type' => 'TEXT',
                'category' => 'User',
                'label' => 'Two factor auth provider?',
                'value' => '',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'address_types',
                'type' => 'SELECT',
                'category' => 'User',
                'label' => 'Address Types',
                'value' => '{"home":"Home","office":"Office","shipping":"Shipping","billing":"Billing"}',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'custom_js',
                'type' => 'TEXTAREA',
                'category' => 'Theme',
                'label' => 'Custom JS',
                'value' => '',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'custom_css',
                'type' => 'TEXTAREA',
                'category' => 'Theme',
                'label' => 'Custom CSS',
                'value' => '',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'custom_admin_js',
                'type' => 'TEXTAREA',
                'category' => 'Theme',
                'label' => 'Custom Admin JS',
                'value' => '',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'custom_admin_css',
                'type' => 'TEXTAREA',
                'category' => 'Theme',
                'label' => 'Custom Admin CSS',
                'value' => '',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'code' => 'supported_languages',
                'type' => 'SELECT',
                'category' => 'General',
                'label' => 'Supported system languages',
                'value' => json_encode(['en' => 'English', 'pt-br' => 'Brazilian', 'ar' => 'Arabic']),
                'editable' => 1,
                'hidden' => 0,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],

        ]);
    }
}
