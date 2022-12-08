<?php

namespace Den1n\NovaQueues\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Job extends Resource
{
    /**
     * The model the resource corresponds to.
     */
    public static $model = '';

    /**
     * The columns that should be searched.
     */
    public static $search = [
        'queue', 'payload',
    ];

    /**
     * Get the value that should be displayed to represent the resource.
     */
    public function title(): string
    {
        return $this->displayName;
    }

    /**
     * Get the search result subtitle for the resource.
     */
    public function subtitle(): string
    {
        return implode(', ', [
            __('Queue') . ': ' . $this->queue,
            __('Attempts') . ': ' . $this->attempts . '/' . $this->maxTries,
            __('Delay') . ': ' . $this->delay,
        ]);
    }

    /**
     * Get the logical group associated with the resource.
     */
    public static function group()
    {
        return __(config('nova-queues.navigation-group', static::$group));
    }

    /**
     * Build an "index" query for the given resource.
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->reorder(
            $request->get('orderBy') ?: 'created_at',
            $request->get('orderByDirection') ?: 'desc'
        );
    }

    /**
     * Get the fields displayed by the resource.
     */
    public function fields(Request $request): array
    {
        return [
            ID::make()->sortable(),

            Text::make(__('Queue'), 'queue')
                ->rules('required', 'string', 'max:255')
                ->sortable(),

            Text::make(__('Name'), 'displayName')
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            Number::make(__('Attempts'), 'attempts')
                ->rules('required')
                ->hideFromDetail()
                ->hideFromIndex()
                ->sortable(),

            Number::make(__('Attempts'), 'attempts', function () {
                return $this->attempts . '/' . $this->maxTries;
            })
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            Number::make(__('Delay'), 'delay')
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            Code::make(__('Payload'), 'payload')->json()
                ->rules('required')
                ->hideFromIndex(),

            DateTime::make(__('Reserved At'), 'reserved_at', function () {
                if ($this->reserved_at) {
                    return Carbon::createFromTimestamp($this->reserved_at)
                        ->setTimezone(config('app.timezone'));
                } else
                    return null;
            })
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->sortable(),

            Number::make(__('Reserved At'), 'reserved_at')
                ->hideFromDetail()
                ->hideFromIndex(),

            DateTime::make(__('Available At'), 'available_at', function () {
                return Carbon::createFromTimestamp($this->available_at)
                    ->setTimezone(config('app.timezone'));
            })
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->sortable(),

            Number::make(__('Available At'), 'available_at')
                ->hideFromDetail()
                ->hideFromIndex(),

            DateTime::make(__('Created At'), 'created_at', function () {
                return Carbon::createFromTimestamp($this->created_at)
                    ->setTimezone(config('app.timezone'));
            })
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->sortable(),

            Number::make(__('Created At'), 'created_at')
                ->hideFromDetail()
                ->hideFromIndex(),
        ];
    }

    /**
     * Get the displayable label of the resource.
     */
    public static function label(): string
    {
        return __('Jobs');
    }

    /**
     * Get the displayable singular label of the resource.
     */
    public static function singularLabel(): string
    {
        return __('Job');
    }

    /**
     * Get the cards available for the request.
     */
    public function cards(Request $request): array
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     */
    public function filters(Request $request): array
    {
        return [
            new \Den1n\NovaQueues\Filters\Queue('job'),
        ];
    }

    /**
     * Get the lenses available for the resource.
     */
    public function lenses(Request $request): array
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     */
    public function actions(Request $request): array
    {
        return [];
    }

    /**
     * Allow the creation of new failed jobs within Laravel Nova
     *
     * @param Request $request
     * @return bool
     */
    public static function authorizedToCreate(Request $request): bool
    {
        return config('nova-queues.can_create.job', false);
    }
}
