<?php

namespace Corals\Modules\Payment\Paytabs\Providers;

use Corals\Foundation\Providers\BaseUpdateModuleServiceProvider;

class UpdateModuleServiceProvider extends BaseUpdateModuleServiceProvider
{
    protected $module_code = 'corals-payment-payment';
    protected $batches_path = __DIR__ . '/../update-batches/*.php';
}
