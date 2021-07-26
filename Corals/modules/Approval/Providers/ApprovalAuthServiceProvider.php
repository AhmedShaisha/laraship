<?php

namespace Corals\Modules\Approval\Providers;

use Corals\Modules\Approval\Models\ApproveRequest;
use Corals\Modules\Approval\Policies\ApproveRequestPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class ApprovalAuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        ApproveRequest::class => ApproveRequestPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
