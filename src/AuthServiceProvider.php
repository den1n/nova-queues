<?php

namespace Den1n\NovaQueues;

use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends \Illuminate\Foundation\Support\Providers\AuthServiceProvider
{
    protected $permissions = [
        'queuesManager',
        'queuesViewJobs',
        'queuesCreateJobs',
        'queuesUpdateJobs',
        'queuesDeleteJobs',
        'queuesViewFailedJobs',
        'queuesCreateFailedJobs',
        'queuesUpdateFailedJobs',
        'queuesDeleteFailedJobs',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->policies = [
            config('nova-queues.models.job') => Policies\Job::class,
            config('nova-queues.models.failed_job') => Policies\FailedJob::class,
        ];

        $this->registerPolicies();

        foreach ($this->permissions as $permission) {
            Gate::define($permission, function ($user) use ($permission) {
                if (method_exists($user, 'hasPermission')) {
                    return $user->hasPermission($permission);
                } else
                    return true;
            });
        }
    }
}
