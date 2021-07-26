<?php

namespace Corals\Modules\Support\Providers;

use Corals\Modules\Support\Models\CustomerSupport;
use Corals\Modules\Support\Policies\CustomerSupportPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class SupportAuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        CustomerSupport::class => CustomerSupportPolicy::class,
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