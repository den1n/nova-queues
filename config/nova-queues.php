<?php

return [

    /**
     * Used models.
     */

    'models' => [
        'job' => \Den1n\NovaQueues\Models\Job::class,
        'failed_job' => \Den1n\NovaQueues\Models\FailedJob::class,
    ],

    /**
     * Resources used by Nova.
     */

    'resources' => [
        'job' => \Den1n\NovaQueues\Resources\Job::class,
        'failed_job' => \Den1n\NovaQueues\Resources\FailedJob::class,
    ],

    /**
     * Names of database tables used by models.
     */

    'tables' => [
        'jobs' => 'jobs',
        'failed_jobs' => 'failed_jobs',
    ],

    /**
     * The group name for the Nova navigation bar in which the package resources will be displayed.
     */

    'navigation-group' => 'Queues',

    'can_create' => [
        'job' => false,
        'failed_job' => false,
    ],

];
