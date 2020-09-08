<?php

namespace Den1n\NovaQueues\Resources;

use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Validation\Validator;
use Laravel\Nova\Http\Requests\NovaRequest;

abstract class Resource extends \Laravel\Nova\Resource
{
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
}
