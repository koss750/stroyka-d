<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Actions\GenerateInvoice;
use Outl1ne\NovaSimpleRepeatable\SimpleRepeatable;

class Order extends Resource
{
    public static $model = \App\Models\Project::class;

    public static $title = 'payment_reference';

    public static $search = [
        'id', 'payment_reference',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('User'),

            Text::make('Design Title', 'design.title'),


            Text::make('IP Address', 'ip_address')
                ->sortable()
                ->rules('required', 'ip'),

            Text::make('Payment Reference')
                ->sortable()
                ->rules('required'),

            Number::make('Payment Amount')
                ->sortable()
                ->rules('required', 'numeric', 'min:0')
                ->step(0.01),

            SimpleRepeatable::make('Selected Configuration', 'selected_configuration')->onlyOnDetail(),

            File::make('File', 'filepath')
                ->disk('public')
                ->path('projects')
                ->prunable()
                ->deletable(),

            Text::make('Created At')
                ->sortable()
                ->exceptOnForms(),

            Text::make('Updated At')
                ->sortable()
                ->exceptOnForms(),
        ];
    }
    public function cards(NovaRequest $request)
    {
        return [];
    }

    public function filters(NovaRequest $request)
    {
        return [];
    }

    public function lenses(NovaRequest $request)
    {
        return [];
    }

    public function actions(NovaRequest $request)
    {
        return [
        ];
    }
}