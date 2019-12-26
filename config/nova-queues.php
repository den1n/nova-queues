<?php

return [

    /**
     * Names of models used by application.
     */

    'models' => [
        'job' => \Den1n\NovaQueues\Models\Job::class,
        'failed_job' => \Den1n\NovaQueues\Models\FailedJob::class,
    ],

    /**
     * Names of resources used by Nova.
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

];
