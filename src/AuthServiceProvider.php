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
        ];

        $this->registerPolicies();

        foreach ($this->permissions as $permission) {
            Gate::define($permission, function ($user) use ($permission) {
                if (class_uses($user)['Den1n\\Permissions\\HasRoles'] ?? false) {
                    return $user->roles->contains(function ($role) use ($permission) {
                        return $role->super or in_array($permission, $role->permissions);
                    });
                } else
                    return true;
            });
        }
    }
}
