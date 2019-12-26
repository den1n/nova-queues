<?php

namespace Den1n\NovaQueues\Resources;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Validation\Validator;
use Laravel\Nova\Http\Requests\NovaRequest;

class Resource extends \Laravel\Nova\Resource
{
    /**
     * Indicates if the resource should be displayed in the sidebar.
     */
    public static $displayInNavigation = false;

    /**
     * Display order of data in index table.
     */
    public static $displayInOrder = [];

    /**
     * Build an "index" query for the given resource.
     */
    public static function indexQuery(NovaRequest $request, $query): Builder
    {
        if (empty($request->get('orderBy'))) {
            $query->getQuery()->orders = [];
            foreach (static::$displayInOrder as $order) {
                $query->orderBy(reset($order), end($order));
            }
        }
        return $query;
    }

    /**
     * Create a validator instance for a resource creation request.
     */
    public static function validatorForCreation(NovaRequest $request): Validator
    {
        return ValidatorFacade::make($request->all(), static::rulesForCreation($request), [],
            trans('nova-queues::validation.attributes')
        )->after(function ($validator) use ($request) {
            static::afterValidation($request, $validator);
            static::afterCreationValidation($request, $validator);
        });
    }

    /**
     * Create a validator instance for a resource update request.
     */
    public static function validatorForUpdate(NovaRequest $request, $resource = null): Validator
    {
        return ValidatorFacade::make($request->all(), static::rulesForUpdate($request, $resource), [],
            trans('nova-queues::validation.attributes')
        )->after(function ($validator) use ($request) {
            static::afterValidation($request, $validator);
            static::afterUpdateValidation($request, $validator);
        });
    }

    /**
     * Get the fields displayed by the resource.
     */
    public function fields(Request $request): array
    {
        return [];
    }
}
