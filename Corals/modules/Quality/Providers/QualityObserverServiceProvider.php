<?php

namespace Corals\Modules\Quality\Providers;

use Corals\Modules\Quality\Models\QualityTest;
use Corals\Modules\Quality\Observers\QualityTestObserver;
use Illuminate\Support\ServiceProvider;

class QualityObserverServiceProvider extends ServiceProvider
{
    /**
     * Register Observers
     */
    public function boot()
    {

        QualityTest::observe(QualityTestObserver::class);
    }
}
