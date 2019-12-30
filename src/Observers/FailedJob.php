<?php

namespace Den1n\NovaQueues\Observers;

use Den1n\NovaQueues\Models\FailedJob as Model;

class FailedJob
{
    /**
     * Handle the Job "saving" event.
     */
    public function saving(Model $job): void
    {
        $job->failed_at = $job->failed_at ?: now();
    }
}
