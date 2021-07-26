<?php

namespace Corals\Modules\Quality\Providers;

use Corals\Modules\Quality\Models\QualityTest;
use Corals\Modules\Quality\Policies\QualityTestPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class QualityAuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        QualityTest::class => QualityTestPolicy::class,
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