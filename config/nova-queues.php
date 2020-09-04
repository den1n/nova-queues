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
     * Policies used by Nova.
     */

    'policies' => [
        'job' => \Den1n\NovaQueues\Policies\Job::class,
        'failed_job' => \Den1n\NovaQueues\Policies\FailedJob::class,
    ],

    /**
     * Names of database tables used by models.
     */

    'tables' => [
        'jobs' => 'jobs',
        'failed_jobs' => 'failed_jobs',
    ],

];
