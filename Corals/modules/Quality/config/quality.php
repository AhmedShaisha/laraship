<?php

return [
    'models' => [
        'qualityTest' => [
            'presenter' => \Corals\Modules\Quality\Transformers\QualityTestPresenter::class,
            'resource_url' => 'qualityTests',
            'shipping_statuses' => 'Quality::status.shipping',
        ],

    ],
    'site_settings' => [

        'Shipping' => [
            'shipping_method' => [
                'label' => 'Quality::labels.settings.shipping.shipping_method',
                'type' => 'select',
                'settings_type' => 'TEXT',
                'options' => [
                    'ship_to_warehouse' => ' Ship to Warehouse',
                    'ship_to_buyer' => 'Ship to Buyer',
                ],
                'required' => true,
            ],
            /* 'shipping_address' => [
        'label' => 'Quality::labels.settings.shipping.shipping_address',
        'type' => 'text',
        'settings_type' => 'TEXT',
        'required' => true,
        ],*/

        ],

    ],
];
