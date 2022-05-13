<?php

namespace Den1n\NovaQueues;

use Illuminate\Http\Request;
use Laravel\Nova\Nova;

class Tool extends \Laravel\Nova\Tool
{
    public function menu(Request $request)
    {
        return [];
    }

    /**
     * Perform any tasks that need to happen when the tool is booted.
     */
    public function boot(): void
    {
        $jobs = config('nova-queues.resources.job');
        $failedJobs = config('nova-queues.resources.failed_job');

        $jobs::$model = config('nova-queues.models.job');
        $failedJobs::$model = config('nova-queues.models.failed_job');

        Nova::resources([
            $jobs,
            $failedJobs,
        ]);
    }
}
