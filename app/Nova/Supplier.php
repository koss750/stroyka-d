<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;

class Supplier extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Supplier::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'company_name';
    
    public static function label()
    {
        return 'Поставщики';
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Company Name', 'company_name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Trading Name', 'trading_name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Address', 'address')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Contact Telephone', 'contact_telephone')
                ->sortable()
                ->rules('required'),

            Text::make('Email', 'email')
                ->sortable()
                ->rules('required', 'email', 'max:255'),

            Number::make('Latitude', 'latitude')
                ->sortable()
                ->rules('nullable', 'numeric')
                ->hideWhenCreating(),

            Number::make('Longitude', 'longitude')
                ->sortable()
                ->rules('nullable', 'numeric')
                ->hideWhenCreating(),
        ];
    }

    // Include any other methods as required for cards, filters, lenses, and actions
}
