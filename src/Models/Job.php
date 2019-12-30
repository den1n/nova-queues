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
        'reserved_at_date',
        'available_at_date',
        'created_at_date',
    ];

    protected $casts = [
        'payload' => 'array',
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

    /**
     * Get value of reserved_at_date attribute.
     */
    public function getReservedAtDateAttribute(): ?DateTimeInterface
    {
        return $this->reserved_at ? Carbon::parse($this->reserved_at) : null;
    }

    /**
     * Get value of available_at_date attribute.
     */
    public function getAvailableAtDateAttribute(): DateTimeInterface
    {
        return Carbon::parse($this->available_at);
    }

    /**
     * Get value of created_at_date attribute.
     */
    public function getCreatedAtDateAttribute(): DateTimeInterface
    {
        return Carbon::parse($this->created_at);
    }
}
