<?php

namespace Den1n\NovaQueues\Policies;

use Den1n\NovaQueues\Models\FailedJob as Model;
use Illuminate\Auth\Access\HandlesAuthorization;

class FailedJob
{
    use HandlesAuthorization;

    public function viewAny($user): bool
    {
        return true;
    }

    public function view($user, Model $job): bool
    {
        return true;
    }

    public function create($user): bool
    {
        return false;
    }

    public function update($user, Model $job): bool
    {
        return false;
    }

    public function delete($user, Model $job): bool
    {
        return false;
    }

    public function restore($user, Model $job): bool
    {
        return false;
    }

    public function forceDelete($user, Model $job): bool
    {
        return false;
    }
}
