<?php

namespace Den1n\NovaQueues\Resources;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;

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
     * Display order of data in index table.
     */
    public static $displayInOrder = [
        ['created_at', 'desc'],
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

            DateTime::make(__('Reserved At'), 'reserved_at_date')
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->sortable(),

            Number::make(__('Reserved At'), 'reserved_at')
                ->hideFromDetail()
                ->hideFromIndex(),

            DateTime::make(__('Available At'), 'available_at_date')
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->sortable(),

            Number::make(__('Available At'), 'available_at')
                ->hideFromDetail()
                ->hideFromIndex(),

            DateTime::make(__('Created At'), 'created_at_date')
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
}
