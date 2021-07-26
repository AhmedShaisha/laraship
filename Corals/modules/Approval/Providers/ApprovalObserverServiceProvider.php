<?php

namespace Corals\Modules\Approval\Providers;

use Corals\Modules\Approval\Models\ApproveRequest;
use Corals\Modules\Approval\Observers\ApproveRequestObserver;
use Illuminate\Support\ServiceProvider;

class ApprovalObserverServiceProvider extends ServiceProvider
{
    /**
     * Register Observers
     */
    public function boot()
    {

        ApproveRequest::observe(ApproveRequestObserver::class);
    }
}
