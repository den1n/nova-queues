<?php

namespace Den1n\NovaQueues\Policies;

use Den1n\NovaQueues\Models\FailedJob as Model;
use Illuminate\Auth\Access\HandlesAuthorization;

class FailedJob
{
    use HandlesAuthorization;

    public function before($user)
    {
        if ($user->can('queuesManager'))
            return true;
    }

    public function viewAny($user): bool
    {
        return $user->can('queuesViewFailedJobs');
    }

    public function view($user, Model $job): bool
    {
        return $user->can('queuesViewFailedJobs');
    }

    public function create($user): bool
    {
        return $user->can('queuesCreateFailedJobs');
    }

    public function update($user, Model $job): bool
    {
        return $user->can('queuesUpdateFailedJobs');
    }

    public function delete($user, Model $job): bool
    {
        return $user->can('queuesDeleteFailedJobs');
    }

    public function restore($user, Model $job): bool
    {
        return $user->can('queuesDeleteFailedJobs');
    }

    public function forceDelete($user, Model $job): bool
    {
        return $user->can('queuesDeleteFailedJobs');
    }
}
