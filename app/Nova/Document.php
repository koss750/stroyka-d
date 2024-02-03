<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use App\Nova\AssociatedCost;
use App\Nova\Design;
use App\Models\Design as DesignModel;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Hidden;
use App\Http\Controllers\RuTranslationController as Translator;
use Laravel\Nova\Http\Requests\NovaRequest;
use Outl1ne\NovaSimpleRepeatable\SimpleRepeatable;
use Laravel\Nova\Panel;
use Ebess\AdvancedNovaMediaLibrary\Fields\Files;
use Laravel\Nova\Fields\Heading;

class Document extends Resource
{

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        $labelCaption = 'documents_nova';
        return Translator::translate($labelCaption); 
    }

    /**
     * Get the singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        $labelCaption = 'documents_nova';
        return Translator::translate($labelCaption); 
    }

    /**
	 * The model the resource corresponds to.
	 *
	 * @var class-string<\App\Models\Design>
	 */
	public static $model = 'App\Models\Design';

    public static $title = ('title');


    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'title'
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
            Heading::make(Translator::translate('section_under_construction')),
            Text::make(Translator::translate('title'), 'title')->onlyOnIndex(),
            Text::make(Translator::translate('size'), 'size')->onlyOnIndex(),
            Files::make('Multiple files', 'multiple_files'),
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
