<?php

namespace Corals\Modules\Payment\Paytabs\Providers;

use Carbon\Carbon;
use Corals\Foundation\Providers\BaseInstallModuleServiceProvider;

class InstallModuleServiceProvider extends BaseInstallModuleServiceProvider
{
    protected function providerBooted()
    {
        $supported_gateways = \Payments::getAvailableGateways();

        $supported_gateways['Paytabs'] = 'Paytabs';
        \Payments::setAvailableGateways($supported_gateways);
        \DB::table('settings')->insert([
            [
                'code' => 'payment_paytabs_serverc_key',
                'type' => 'TEXT',
                'category' => 'Payment',
                'label' => 'payment_paytabs_serverc_key',
                'value' => 'live_public_xxxxxxxxxxxxxxxxxxxxxx',
                'editable' => 1,
                'hidden' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

      /*  \DB::table('gateway_status')->insert([
            [
                'gateway' => 'Paytabs',
                'object_type' => 'Corals\Modules\Subscriptions\Models\Plan',
                'object_id' => 5,
                'object_reference' => 'gold',
                'status' => 'CREATED',
            ],
            [
                'gateway' => 'Stripe',
                'object_type' => 'Corals\Modules\Subscriptions\Models\Plan',
                'object_id' => 4,
                'object_reference' => 'silver',
                'status' => 'CREATED',
            ],
            [
                'gateway' => 'Stripe',
                'object_type' => 'Corals\Modules\Subscriptions\Models\Plan',
                'object_id' => 3,
                'object_reference' => 'bronze',
                'status' => 'CREATED',
            ],
            [
                'gateway' => 'Stripe',
                'object_type' => 'Corals\Modules\Subscriptions\Models\Plan',
                'object_id' => 8,
                'object_reference' => 'business',
                'status' => 'CREATED',
            ],
            [
                'gateway' => 'Stripe',
                'object_type' => 'Corals\Modules\Subscriptions\Models\Plan',
                'object_id' => 7,
                'object_reference' => 'professional',
                'status' => 'CREATED',
            ],
            [
                'gateway' => 'Stripe',
                'object_type' => 'Corals\Modules\Subscriptions\Models\Plan',
                'object_id' => 6,
                'object_reference' => 'basic',
                'status' => 'CREATED',
            ],
            [
                'gateway' => 'Stripe',
                'object_type' => 'Corals\Modules\Subscriptions\Models\Plan',
                'object_id' => 12,
                'object_reference' => 'platinuim',
                'status' => 'CREATED',
            ],
            [
                'gateway' => 'Stripe',
                'object_type' => 'Corals\Modules\Subscriptions\Models\Plan',
                'object_id' => 11,
                'object_reference' => 'bushosting',
                'status' => 'CREATED',
            ],
            [
                'gateway' => 'Stripe',
                'object_type' => 'Corals\Modules\Subscriptions\Models\Plan',
                'object_id' => 10,
                'object_reference' => 'corporate',
                'status' => 'CREATED',
            ],
            [
                'gateway' => 'Stripe',
                'object_type' => 'Corals\Modules\Subscriptions\Models\Plan',
                'object_id' => 9,
                'object_reference' => 'basichosting',
                'status' => 'CREATED',
            ],
        ]);*/
    }
}
