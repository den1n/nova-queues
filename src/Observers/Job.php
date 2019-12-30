<?php

namespace Den1n\NovaQueues\Observers;

use Den1n\NovaQueues\Models\Job as Model;

class Job
{
    /**
     * Handle the Job "saving" event.
     */
    public function saving(Model $job): void
    {
        $timestamp = now()->getTimeStamp();
        $job->available_at = $job->available_at ?: $timestamp;
        $job->created_at = $job->created_at ?: $timestamp;
    }
}
