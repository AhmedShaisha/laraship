<?php

return [
    'name' => 'Paytabs',
    'key' => 'Paytabs',
    'support_subscription' => false,
    'support_ecommerce' => false,
    'support_marketplace' => true,
    'support_online_refund' => false,
    'manage_remote_plan' => false,
    'require_token_confirm' => false,
    'manage_remote_product' => false,
    'manage_remote_sku' => false,
    'manage_remote_order' => false,
    'supports_swap' => false,
    'supports_swap_in_grace_period' => false,
    'require_invoice_creation' => true,
    'require_plan_activation' => false,
    'capture_payment_method' => false,
    'require_default_payment_set' => false,
    'can_update_payment' => false,
    'create_remote_customer' => false,
    'require_payment_token' => false,
    'support_reservation' => false,

    'settings' => [
        'server_key' => [
            'label' => 'Paytabs::labels.settings.server_key',
            'type' => 'text',
            'required' => false,
        ]
    
    ] ,
   /* 'events' => [
        'invoice.created' => \Corals\Modules\Payment\Stripe\Job\HandleInvoiceCreated::class,
        'invoice.payment_succeeded' => \Corals\Modules\Payment\Stripe\Job\HandleInvoicePaymentSucceeded::class,
        'invoice.payment_failed' => \Corals\Modules\Payment\Stripe\Job\HandleInvoicePaymentFailed::class,
        'customer.subscription.deleted' => \Corals\Modules\Payment\Stripe\Job\HandleCustomerSubscriptionDeleted::class,
        'customer.subscription.trial_will_end' => \Corals\Modules\Payment\Stripe\Job\HandleCustomerTrialWillEnd::class,
    ],*/
    'webhook_handler' => \Corals\Modules\Payment\Paytabs\Gateway::class,
];
