<?php

namespace Corals\Modules\Support\Providers;

use Corals\Modules\Support\Models\CustomerSupport;
use Corals\Modules\Support\Observers\CustomerSupportObserver;
use Illuminate\Support\ServiceProvider;

class SupportObserverServiceProvider extends ServiceProvider
{
    /**
     * Register Observers
     */
    public function boot()
    {

        CustomerSupport::observe(CustomerSupportObserver::class);
    }
}
