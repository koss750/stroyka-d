<?php

namespace App\Nova;

use App\Models\ExcelFileType; // Assuming this is the correct namespace
use Laravel\Nova\Fields\ID;
use App\Nova\AssociatedCost;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use Outl1ne\NovaSimpleRepeatable\SimpleRepeatable;
use Laravel\Nova\Panel;

class ExcelCosts extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\ExcelCosts>
     */
    public static $model = \App\Models\ExcelFileType::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'file';


    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static function search(NovaRequest $request, $query)
    {
        return $query->where('type', 'like', $request->search . '%')
                     ->orWhere('subtype', 'like', $request->search . '%')
                     ->orWhere('file', 'like', $request->search . '%');
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
    
            Text::make('Type')
                ->sortable()
                ->rules('required', 'max:255'),
    
            Text::make('Subtype')
                ->sortable()
                ->rules('required', 'max:255'),
                
            //Original hasmany field
            //HasMany::make('Associated Costs', 'associatedCosts', 'App\Nova\AssociatedCost'),
            Panel::make('Associated Costs', [
            SimpleRepeatable::make('Associated Costs', 'associatedCosts', [
                Text::make('Description', 'description'),
                Text::make('Cell', 'title_cell'),
                Text::make('Unit', 'unit'),
                Text::make('Cell', 'unit_cell'),
                Text::make('Value', 'value'),
                Text::make('Cell', 'location_cell')->rules('required', 'regex:/^[A-Za-z]+[0-9]+$/', 'max:10'),
                
            ])->canAddRows(true)->addRowLabel("+ добавить поле"),
        ]),
            

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
