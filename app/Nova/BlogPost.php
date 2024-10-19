<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Laravel\Nova\Resource;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\Hidden;

class BlogPost extends Resource
{
    public static $model = \App\Models\BlogPost::class;

    public static $title = 'title';

    public static $search = [
        'id', 'title', 'content', 'author',
    ];

    public static function label()
    {
        return 'Блог';
    }

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Заголовок', 'title')
                ->sortable()
                ->rules('required', 'max:255'),

            Trix::make('Содержание', 'content')
                ->rules('required')
                ->hideFromIndex(),

            Text::make('Краткое описание', 'short_description')
                ->rules('required', 'max:255'),

            Text::make('Автор', 'author')
                ->sortable()
                ->rules('required', 'max:255')
                ->hideFromIndex(),

            Text::make('Теги', 'tags')
                ->displayUsing(function ($tags) {
                    return is_array($tags) ? implode(', ', $tags) : $tags;
                })
                ->hideFromIndex(),

            Boolean::make('Теги сгенерированы', 'are_tags_generated')
                ->hideFromIndex(),

            Text::make('Ссылка', 'slug')
                ->default(function () {
                    return (random_int(1000, 9999) . '-' . random_int(1000, 9999));
                })
                ->onlyOnForms(),

            Number::make('Количество просмотров', 'view_count')
                ->sortable(),

            Boolean::make('Опубликовано', 'is_published'),

            Boolean::make('Избранное', 'is_featured')
                ->hideFromIndex(),

            Boolean::make('В архиве', 'is_archived')
                ->hideFromIndex(),

            Images::make('Изображения', 'images') // 'images' is the media collection name
                ->conversionOnIndexView('thumb')
                ->fullSize(),

            DateTime::make('Создано', 'created_at')
                ->sortable()
                ->hideFromIndex()
                ->onlyOnDetail(),

            DateTime::make('Обновлено', 'updated_at')
                ->sortable()
                ->hideFromIndex()
                ->onlyOnDetail(),
        ];
    }
}
