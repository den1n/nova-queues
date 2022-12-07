<?php

namespace Den1n\NovaQueues\Models;

class FailedJob extends \Illuminate\Database\Eloquent\Model
{
    protected $guarded = [
        'id',
    ];

    protected $appends = [
        'displayName',
        'maxTries',
        'delay',
    ];

    protected $casts = [
        'payload' => 'array',
    ];

    protected $dates = [
        'failed_at',
    ];

    public $timestamps = false;

    /**
     * The "booting" method of the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function (self $job) {
            $job->failed_at = $job->failed_at ?: now();
        });
    }

    /**
     * Get the table associated with the model.
     */
    public function getTable(): string
    {
        return config('nova-queues.tables.failed_jobs', parent::getTable());
    }

    /**
     * Get value of displayName attribute.
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->payload['displayName'];
    }

    /**
     * Get value of maxTries attribute.
     */
    public function getMaxTriesAttribute(): int
    {
        return $this->payload['maxTries'];
    }

    /**
     * Get value of delay attribute.
     */
    public function getDelayAttribute(): int
    {
        return $this->payload['delay'];
    }

    /**
     * Allow the creation of new failed jobs within Laravel Nova
     *
     * @param Request $request
     * @return mixed
     */
    public static function authorizedToCreate(Request $request)
    {
        return config('nova-queues.can_create.failed_job', false);
    }
}
