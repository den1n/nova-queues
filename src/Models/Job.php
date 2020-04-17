<?php

namespace Den1n\NovaQueues\Models;

use Carbon\Carbon;
use DateTimeInterface;

class Job extends \Illuminate\Database\Eloquent\Model
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

    public $timestamps = false;

    /**
     * The "booting" method of the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function (self $job) {
            $timestamp = now()->getTimeStamp();
            $job->available_at = $job->available_at ?: $timestamp;
            $job->created_at = $job->created_at ?: $timestamp;
        });
    }

    /**
     * Get the table associated with the model.
     */
    public function getTable(): string
    {
        return config('nova-queues.tables.jobs', parent::getTable());
    }

    /**
     * Get value of displayName attribute.
     */
    public function getDisplayNameAttribute(): string
    {
        return $this->payload['displayName'] ?? '';
    }

    /**
     * Get value of maxTries attribute.
     */
    public function getMaxTriesAttribute(): int
    {
        return $this->payload['maxTries'] ?? 0;
    }

    /**
     * Get value of delay attribute.
     */
    public function getDelayAttribute(): int
    {
        return $this->payload['delay'] ?? 0;
    }
}
