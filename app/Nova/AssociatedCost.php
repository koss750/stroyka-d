<?php

namespace App\Nova;

use App\Models\ExcelFileType; // Assuming this is the correct namespace
use Laravel\Nova\Fields\ID;
use App\Nova\AssociatedCost;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasMany;
use App\Http\Controllers\RuTranslationController as Translator;
use Laravel\Nova\Http\Requests\NovaRequest;
use Outl1ne\NovaSimpleRepeatable\SimpleRepeatable;
use Laravel\Nova\Panel;

class AssociatedCost extends Resource
{

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        $labelCaption = 'templates_and_costs_nova';
        return Translator::translate($labelCaption); 
    }

    /**
     * Get the singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        $labelCaption = 'templates_and_costs_nova';
        return Translator::translate($labelCaption); 
    }

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
    public static $title = 'subtype';


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
            Text::make(Translator::translate('tmp_type_label'), 'type')
                ->sortable()
                ->rules('required', 'max:30'),
    
            Text::make(Translator::translate('tmp_stype_label'), "subtype")
                ->sortable()
                ->rules('required', 'max:30'),
                
            //Original hasmany field
            //HasMany::make(Translator::translate('ass_co_panel_label'), 'associatedCosts', 'App\Nova\AssociatedCost'),
            Panel::make(Translator::translate('ass_co_panel_label'), [
            SimpleRepeatable::make(Translator::translate('ass_co_repeatable_label'), 'associatedCosts', [
                Text::make(Translator::translate('ass_co_type_label'), 'type'),
                Text::make(Translator::translate('ass_co_descr_label'), 'description'),
                Text::make(Translator::translate('ass_co_unit_label'), 'unit'),
                //Text::make(Translator::translate('ass_co_row_label'), 'cell'),
                Text::make(Translator::translate(Translator::translate('ass_co_val_label'), 'value'))
            ])->canAddRows(true)->addRowLabel(Translator::translate('table_add_field_label')),
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
