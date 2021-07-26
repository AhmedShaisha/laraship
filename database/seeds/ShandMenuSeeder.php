<?php

use Illuminate\Database\Seeder;

class ShandMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (class_exists(\Corals\Menu\Models\Menu::class) && \Schema::hasTable('posts')) {
            // seed root menus
            $topMenu = Corals\Menu\Models\Menu::updateOrCreate(['key' => 'frontend_top'], [
                'parent_id' => 0,
                'url' => null,
                'name' => 'Shand Top',
                'description' => 'Shand Top Menu',
                'icon' => null,
                'target' => null,
                'order' => 0
            ]);
        
            $topMenuId = $topMenu->id;
        
            // seed children menu
            Corals\Menu\Models\Menu::updateOrCreate(['key' => 'Just in'], [
                'parent_id' => $topMenuId,
                'url' => 'just_in',
                'active_menu_url' => 'just_in',
                'name' => 'Just in',
                'description' => 'Just in Menu Item',
                'icon' => null,
                'target' => null,
                'order' => 0
            ]);

            Corals\Menu\Models\Menu::updateOrCreate(['key' => 'Brands'], [
                'parent_id' => $topMenuId,
                'url' => 'brands',
                'active_menu_url' => 'brands',
                'name' => 'Brands',
                'description' => 'Brands in Menu Item',
                'icon' => null,
                'target' => null,
                'order' => 0
            ]);
            
            Corals\Menu\Models\Menu::updateOrCreate(['key' => 'Women'], [
                'parent_id' => $topMenuId,
                'url' => 'women',
                'active_menu_url' => 'women',
                'name' => 'Women',
                'description' => 'Women in Menu Item',
                'icon' => null,
                'target' => null,
                'order' => 0
            ]);
            Corals\Menu\Models\Menu::updateOrCreate(['key' => 'Men'], [
                'parent_id' => $topMenuId,
                'url' => 'men',
                'active_menu_url' => 'men',
                'name' => 'Men',
                'description' => 'Men in Menu Item',
                'icon' => null,
                'target' => null,
                'order' => 0
            ]);
            
            Corals\Menu\Models\Menu::updateOrCreate(['key' => 'Kids'], [
                'parent_id' => $topMenuId,
                'url' => 'kids',
                'active_menu_url' => 'kids',
                'name' => 'Kids',
                'description' => 'kids in Menu Item',
                'icon' => null,
                'target' => null,
                'order' => 0
            ]);

            Corals\Menu\Models\Menu::updateOrCreate(['key' => 'Bags'], [
                'parent_id' => $topMenuId,
                'url' => 'bags',
                'active_menu_url' => 'bags',
                'name' => 'Bags',
                'description' => 'bags in Menu Item',
                'icon' => null,
                'target' => null,
                'order' => 0
            ]);


            Corals\Menu\Models\Menu::updateOrCreate(['key' => 'Watches_and_Jewelry'], [
                'parent_id' => $topMenuId,
                'url' => 'Watches_and_Jewelry',
                'active_menu_url' => 'Watches_and_Jewelry',
                'name' => 'Watches and Jewelry',
                'description' => 'Watches and Jewelry in Menu Item',
                'icon' => null,
                'target' => null,
                'order' => 0
            ]);
            Corals\Menu\Models\Menu::updateOrCreate(['parent_id' => $topMenuId, 'key' => 'shop'], [
                'url' => 'shop',
                'active_menu_url' => 'shop',
                'name' => 'Shop',
                'description' => 'Shop Menu Item',
                'icon' => null,
                'target' => null,
                'order' => 965
            ]);



            $footerMenu = Corals\Menu\Models\Menu::updateOrCreate(['key' => 'frontend_footer'], [
                'parent_id' => 0,
                'url' => null,
                'name' => 'Frontend Footer',
                'description' => 'Frontend Footer Menu',
                'icon' => null,
                'target' => null,
                'order' => 0
            ]);
        
            $footerMenuId = $footerMenu->id;
        
        // seed children menu
      
            Corals\Menu\Models\Menu::updateOrCreate([
                'parent_id' => $footerMenuId,
                'key' => null,
                'url' => 'about-us',
                'active_menu_url' => 'about-us',
                'name' => 'About Us',
                'description' => 'About Us Menu Item',
                'icon' => null,
                'target' => null,
                'order' => 980
            ]);
            Corals\Menu\Models\Menu::updateOrCreate([
                'parent_id' => $footerMenuId,
                'key' => null,
                'url' => 'contact-us',
                'active_menu_url' => 'contact-us',
                'name' => 'Contact Us',
                'description' => 'Contact Us Menu Item',
                'icon' => null,
                'target' => null,
                'order' => 980
            ]);
            Corals\Menu\Models\Menu::updateOrCreate([
                'parent_id' => $footerMenuId,
                'key' => null,
                'url' => 'blog',
                'active_menu_url' => 'blog',
                'name' => 'Blog',
                'description' => 'Blog Menu Item',
                'icon' => null,
                'target' => null,
                'order' => 980
            ]);
        
        
        
            Corals\Menu\Models\Menu::updateOrCreate([
                'parent_id' => $footerMenuId,
                'key' => null,
                'url' => 'pricing',
                'active_menu_url' => 'pricing',
                'name' => 'Pricing',
                'description' => 'Pricing Menu Item',
                'icon' => null,
                'target' => null,
                'order' => 980
            ]);
        
            Corals\Menu\Models\Menu::updateOrCreate([
                'parent_id' => $footerMenuId,
                'key' => null,
                'url' => 'faqs',
                'active_menu_url' => 'faqs',
                'name' => 'FAQs',
                'description' => 'FAQs',
                'icon' => null,
                'target' => null,
                'order' => 970
            ]);
        
       /*     Corals\Menu\Models\Menu::updateOrCreate([
                'parent_id' => $topMenuId,
                'key' => null,
                'url' => 'about-us',
                'active_menu_url' => 'about-us',
                'name' => 'About Us',
                'description' => 'About Us Menu Item',
                'icon' => null,
                'target' => null,
                'order' => 970
            ]);
        
            Corals\Menu\Models\Menu::updateOrCreate([
                'parent_id' => $topMenuId,
                'key' => null,
                'url' => 'blog',
                'active_menu_url' => 'blog',
                'name' => 'Blog',
                'description' => 'Blog Menu Item',
                'icon' => null,
                'target' => null,
                'order' => 980
            ]);
            Corals\Menu\Models\Menu::updateOrCreate([
                'parent_id' => $topMenuId,
                'key' => null,
                'url' => 'pricing',
                'active_menu_url' => 'pricing',
                'name' => 'Pricing',
                'description' => 'Pricing Menu Item',
                'icon' => null,
                'target' => null,
                'order' => 980
            ]);
        
            Corals\Menu\Models\Menu::updateOrCreate([
                'parent_id' => $topMenuId,
                'key' => null,
                'url' => 'faqs',
                'active_menu_url' => 'faqs',
                'name' => 'FAQs',
                'description' => 'FAQs',
                'icon' => null,
                'target' => null,
                'order' => 970
            ]);
        
            Corals\Menu\Models\Menu::updateOrCreate([
                'parent_id' => $topMenuId,
                'key' => null,
                'url' => 'contact-us',
                'active_menu_url' => 'contact-us',
                'name' => 'Contact Us',
                'description' => 'Contact Us Menu Item',
                'icon' => null,
                'target' => null,
                'order' => 980
            ]);*/
    }
}
}