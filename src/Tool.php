<?php

namespace Den1n\NovaQueues;

use Laravel\Nova\Nova;

class Tool extends \Laravel\Nova\Tool
{
    /**
     * Perform any tasks that need to happen when the tool is booted.
     */
    public function boot(): void
    {
        $models = config('nova-queues.models');
        $resources = config('nova-queues.resources');
        foreach ($resources as $name => $class) {
            $class::$model = $models[$name];
            Nova::resources([$class]);
        }
    }

	/**
	 * Build the view that renders the navigation links for the tool.
	 */
	public function renderNavigation()
	{
		return view('nova-queues::navigation', [
            'jobsUriKey' => config('nova-queues.resources.job')::uriKey(),
            'failedJobsUriKey' => config('nova-queues.resources.failed_job')::uriKey(),
        ]);
	}
}
