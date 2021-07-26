<?php

namespace Corals\Modules\Approval;

use Corals\Modules\Approval\Facades\Approval;
use Corals\Modules\Approval\Models\ApproveRequest;
use Corals\Modules\Approval\Providers\ApprovalAuthServiceProvider;
use Corals\Modules\Approval\Providers\ApprovalObserverServiceProvider;
use Corals\Modules\Approval\Providers\ApprovalRouteServiceProvider;

use Corals\Settings\Facades\Settings;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

//add
use Corals\User\Communication\Facades\CoralsNotification;
use Corals\Modules\Approval\Notifications\NewRequestCreated;

class ApprovalServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'Approval');

        // Load translation
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'Approval');

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
        $this->mergeConfigFrom(__DIR__ . '/config/approval.php', 'approval');

        $this->app->register(ApprovalRouteServiceProvider::class);
        $this->app->register(ApprovalAuthServiceProvider::class);
        $this->app->register(ApprovalObserverServiceProvider::class);

        $this->app->booted(function () {
            $loader = AliasLoader::getInstance();
            $loader->alias('Approval', Approval::class);
        });
    }

    protected function registerCustomFieldsModels()
    {
        Settings::addCustomFieldModel(ApproveRequest::class);
    }
     //added by Wafa
     protected function addEvents()
     {
         CoralsNotification::addEvent(
             'notifications.approval.new_request.created',
             'New Approve Request Received',
             NewRequestCreated::class);
     }
     //end
}
