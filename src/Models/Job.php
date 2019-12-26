<?php

namespace Den1n\NovaQueues\Models;

class Job extends \Illuminate\Database\Eloquent\Model
{
    protected $guarded = [
        'id',
    ];

    protected $attributes = [
        'created_at' => 'now',
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
        'reserved_at',
        'available_at',
        'created_at',
    ];

    public $timestamps = false;

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
}
