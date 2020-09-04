<?php

namespace Den1n\NovaQueues;

use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends \Illuminate\Foundation\Support\Providers\AuthServiceProvider
{
    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->policies = [
            config('nova-queues.models.job') => config('nova-queues.policies.job'),
            config('nova-queues.models.failed_job') => config('nova-queues.policies.failed_job'),
        ];

        $this->registerPolicies();
    }
}
