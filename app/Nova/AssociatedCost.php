<?php

namespace App\Nova;

use App\Models\AssociatedCosts as AssociatedCostModel; // Import the AssociatedCost model
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class AssociatedCost extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\AssociatedCost>
     */
    public static $model = AssociatedCostModel::class;
    
    public static $perPageViaRelationship = 200;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'location_cell';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'location_cell', 'description'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
    
            BelongsTo::make('Excel File Type', 'excelFileType', ExcelCosts::class),
    
            Text::make('Description')
                ->sortable()
                ->rules('required', 'max:255'),
    
            Text::make('Location Cell')
                ->sortable()
                ->rules('required', 'max:255'),
    
            Text::make('Value')
                ->sortable()
                ->rules('required', 'max:255'),
    
            // Add more fields as needed...
        ];
    }


    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
