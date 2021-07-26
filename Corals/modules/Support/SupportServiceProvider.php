<?php

namespace Corals\Modules\Support;

use Corals\Modules\Support\Facades\Support;
use Corals\Modules\Support\Models\CustomerSupport;
use Corals\Modules\Support\Models\Response;
use Corals\Modules\Support\Providers\SupportAuthServiceProvider;
use Corals\Modules\Support\Providers\SupportObserverServiceProvider;
use Corals\Modules\Support\Providers\SupportRouteServiceProvider;
use Corals\Modules\Support\Notifications\CustomerSupportCreated;
use Corals\Modules\Support\Notifications\ResponesCreated;
use Corals\User\Communication\Facades\CoralsNotification;
use Corals\Settings\Facades\Settings;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Corals\Modules\Utility\Facades\Utility;
class SupportServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */

    public function boot()
    {
        // Load view
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'Support');

        // Load translation
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'Support');

        // Load migrations
//        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->registerCustomFieldsModels();
        //added
        $this->addEvents();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/support.php', 'support');

        $this->app->register(SupportRouteServiceProvider::class);
        $this->app->register(SupportAuthServiceProvider::class);
        $this->app->register(SupportObserverServiceProvider::class);

        $this->app->booted(function () {
            $loader = AliasLoader::getInstance();
            $loader->alias('Support', Support::class);
        });
        Utility::addToUtilityModules('Support');
    }

    protected function registerCustomFieldsModels()
    {
        Settings::addCustomFieldModel(Support::class);
    }
    protected function addEvents()
    {
        
        CoralsNotification::addEvent(
            'notifications.support.customerSupport_created',
            'New Customer Support Request',
            CustomerSupportCreated::class);

            CoralsNotification::addEvent(
                'notifications.support.response_created',
                'Respones for Customer Support Request',
                ResponesCreated::class);
            
    }
}