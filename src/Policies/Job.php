<?php

namespace Den1n\NovaQueues\Policies;

use Den1n\NovaQueues\Models\Job as Model;
use Illuminate\Auth\Access\HandlesAuthorization;

class Job
{
    use HandlesAuthorization;

    public function before($user)
    {
        if ($user->can('queuesManager'))
            return true;
    }

    public function viewAny($user): bool
    {
        return $user->can('queuesViewJobs');
    }

    public function view($user, Model $job): bool
    {
        return $user->can('queuesViewJobs');
    }

    public function create($user): bool
    {
        return $user->can('queuesCreateJobs');
    }

    public function update($user, Model $job): bool
    {
        return $user->can('queuesUpdateJobs');
    }

    public function delete($user, Model $job): bool
    {
        return $user->can('queuesDeleteJobs');
    }

    public function restore($user, Model $job): bool
    {
        return $user->can('queuesDeleteJobs');
    }

    public function forceDelete($user, Model $job): bool
    {
        return $user->can('queuesDeleteJobs');
    }
}
