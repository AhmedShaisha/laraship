<?php

namespace Corals\Modules\Quality;

use Corals\Modules\Quality\Facades\Quality;
use Corals\Modules\Quality\Models\QualityTest;
use Corals\Modules\Quality\Providers\QualityAuthServiceProvider;
use Corals\Modules\Quality\Providers\QualityObserverServiceProvider;
use Corals\Modules\Quality\Providers\QualityRouteServiceProvider;

use Corals\Settings\Facades\Settings;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

use Corals\User\Communication\Facades\CoralsNotification;
use Corals\Modules\Quality\Notifications\QualityTestCreated;
use Corals\Modules\Quality\Notifications\SellerWarningMessage;
use Corals\Modules\Quality\Notifications\BuyerApologyMessage;
use Corals\Modules\Quality\Notifications\BuyerFormAgreement;
use Corals\Modules\Quality\Notifications\ResponsibleQualityTestNotification;
use Corals\Modules\Quality\Notifications\ShippingAddressQualityTestNotification;
use Corals\Modules\Quality\Notifications\ProductAcceptQuaualityTestNotification;
use Corals\Modules\Quality\Notifications\ShippingToBuyerNotification;
use Corals\Modules\Quality\Notifications\BuyerResponseNotification;
use Corals\Modules\Quality\Notifications\SellerResponseNotification;

class QualityServiceProvider extends ServiceProvider
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
        $this->loadViewsFrom(__DIR__ . '/resources/views', 'Quality');

        // Load translation
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'Quality');

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
        $this->mergeConfigFrom(__DIR__ . '/config/quality.php', 'quality');

        $this->app->register(QualityRouteServiceProvider::class);
        $this->app->register(QualityAuthServiceProvider::class);
        $this->app->register(QualityObserverServiceProvider::class);

        $this->app->booted(function () {
            $loader = AliasLoader::getInstance();
            $loader->alias('Quality', Quality::class);
        });
    }

    protected function registerCustomFieldsModels()
    {
        Settings::addCustomFieldModel(QualityTest::class);
    }

    //added by Wafa
    protected function addEvents()
    {
        CoralsNotification::addEvent(
            'notifications.qualityTest.qualityTest_created',
            'New Quality Test created',
            QualityTestCreated::class);

        CoralsNotification::addEvent(
            'notifications.qualityTest.warning_seller',
            'Warning Message To The Seller',
            SellerWarningMessage::class);
                
        CoralsNotification::addEvent(
            'notifications.qualityTest.buyer_apology',
            'Apology Message To The Buyer',
            BuyerApologyMessage::class);
         
        CoralsNotification::addEvent(
            'notifications.qualityTest.Buyer_FormAgreement',
            'Buyer Form Agreement',
            BuyerFormAgreement::class); 
                  
        CoralsNotification::addEvent(
            'notifications.qualityTest.responsible_qualityTest',
            'Responsible Quality Test  ',
            ResponsibleQualityTestNotification::class);

        CoralsNotification::addEvent(
            'notifications.qualityTest.shipping_address.qualityTest',
            'Quality Test Shipping Address  ',
            ShippingAddressQualityTestNotification::class);

        CoralsNotification::addEvent(
            'notifications.qualityTest.product_accept.qualityTest',
            'Quality Test Product Accepted  ',
            ProductAcceptQuaualityTestNotification::class);
    
        CoralsNotification::addEvent(
            'notifications.qualityTest.shipping_Buyer',
            'Shipping Order To Buyer ',
            ShippingToBuyerNotification::class);  
                               
        CoralsNotification::addEvent(
            'notifications.qualityTest.buyer_response',
            'Buyer Response Notification ',
            BuyerResponseNotification::class); 

        CoralsNotification::addEvent(
            'notifications.qualityTest.seller_response',
            'Seller Response Notification ',
            SellerResponseNotification::class);                
                     
    }
    //end
}
