<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\RuTranslationController as Translator;

class GenerateExcel extends Action
{
    use InteractsWithQueue, Queueable;


    /**
     * Get the displayable name of the action.
     *
     * @return string
     */
    public function name()
    {
        return Translator::translate('foundation_action');
    }
    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $sheetType = $fields->get('sheet_type');
    
        if ($sheetType === 'fLenta') {
            foreach ($models as $model) {
                $tapeWidth = $fields->get('tape_width');
                $save = $model->foundationLentaExcel($tapeWidth);
                $filePath = $save["publicPath"];
                $fileName = $save["fileName"];

                // After generating the file and saving it to $filePath
                // Return the download response using Nova's built-in DownloadResponse
                return Action::download($filePath, $fileName);
            }
        }
    
        return Action::message('Excel file generated successfully!');
        
    }


    public function fields(NovaRequest $request)
    {
        return [
            Select::make('Фундамент', 'sheet_type')
                ->options([
                    'fLenta' => 'Ленточный',
                    // You can add more sheet types here in the future
                ])->help('Выберите тип фундамента')
                ->displayUsingLabels()
                ->help('Select the type of Excel sheet to generate'),
            Select::make('Сечения', 'tape_width')
                ->options([
                    '300x600' => '300x600',
                    '300x700' => '300x700',
                    '300x800' => '300x800',
                    '300x900' => '300x900',
                    '300x1000' => '300x1000',
                    '400x600' => '400x600',
                    '400x700' => '400x700',
                    '400x800' => '400x800',
                    '400x900' => '400x900',
                    '400x1000' => '400x1000',
                    '500x600' => '500x600',
                    '500x700' => '500x700',
                    '500x800' => '500x800',
                    '500x900' => '500x900',
                    '500x1000' => '500x1000',
                    '600x700' => '600x700',
                    '600x800' => '600x800',
                    '600x900' => '600x900',
                    '600x1000' => '600x1000',
                ])
                ->displayUsingLabels()
                ->sortable()
                ->help('Выберите ширину ленты')
        ];
    }
}
