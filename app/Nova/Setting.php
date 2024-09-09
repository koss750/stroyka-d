<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Textarea;

class Setting extends Resource
{
    public static $model = \App\Models\Setting::class;

    public static $title = 'title';

    public static $search = [
        'id', 'label', 'title', 'value',
    ];

    public static function label()
    {
        return "Настройки";
    }

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Параметр', 'label')
                ->sortable()
                ->rules('required', 'max:255')
                ->creationRules('unique:settings,label')
                ->hideFromIndex()
                ->updateRules('unique:settings,label,{{resourceId}}'),

            Text::make('Название', 'title')
                ->sortable()
                ->rules('required', 'max:255'),

            TextArea::make('Значение', 'value')
                ->rules('required')
                ->hideFromIndex()
                ->displayUsing(function ($value) {
                    return $this->label === 'display_prices' 
                        ? $this->displayPricesOptions()[$value] ?? $value 
                        : $value;
                }),

            Select::make('Значение', 'value')
                ->options($this->displayPricesOptions())
                ->displayUsingLabels()
                ->onlyOnForms()
                ->hideWhenUpdating(function ($request) {
                    return $this->label !== 'display_prices';
                })
                ->rules('required_if:label,display_prices'),

            Select::make('Влияние на пользователей', 'affected_users')
                ->options([
                    'all' => 'Все пользователи',
                    'authenticated' => 'Authenticated Users',
                    'admin' => 'Admin Users',
                ])
                ->displayUsingLabels()
                ->default('all')
                ->rules('required'),

            Select::make('Влияние на области', 'affected_areas')
                ->options([
                    'site' => 'Весь сайт',
                    'admin' => 'Админка',
                    'frontend' => 'Фронтенд',
                ])
                ->displayUsingLabels()
                ->default('site')
                ->rules('required'),
        ];
    }

    private function displayPricesOptions()
    {
        return [
            'material' => 'Только материалы',
            'labour' => 'Только работы',
            'total' => 'Материалы + Работы',
        ];
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->orderBy('label');
    }
}