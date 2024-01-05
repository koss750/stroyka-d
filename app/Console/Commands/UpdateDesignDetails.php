<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Design;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\RuTranslationController as Translator;

class UpdateDesignDetails extends Command
{
    /**
     * The name and signature of the console command.
     * 
     * @var string
     */
    protected $signature = 'design:details {design_id? : The ID of the design}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Use AI to update a specific design description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $designId = $this->argument('design_id');
        if (isset($designId)) {
            $this->updateOne($designId);
        } else {
            $this->updateAll();
        }
    }

    public function updateOne($id) {
            $design = Design::find($id);
            if ($design && empty($design->details)) {
                $imageUrl = $design->getImageUrl();
                //dd($design);
                if ($imageUrl) {
                    $this->info("Updating details for design ID {$design->id}...");
                    $formattedFloor = [];
                    foreach ($design->floorsList as $floors) {
                        foreach ($floors as $propKey => $propVal) {
                            $formattedFloor[] = Translator::translate($propKey) . ': ' . $propVal;
                        }
                    }
                    
                    $floors = implode(', ', $formattedFloor);
                    $prompt = "Please give me a description in Russian of around 100-150 characters about this house plan. It looks like {$imageUrl}, it's area is {$design->size} and here is a php implode of the array of rooms it has {$floors}. Description should be styled for a sales channel such as a website";

                    $response = Http::withHeaders([
                        'Content-Type' => 'application/json',
                        'Authorization' => 'Bearer '  . config('services.openai.api_key')
                    ])->post('https://api.openai.com/v1/chat/completions', [
                        'model' => 'gpt-3.5-turbo',
                        'messages' => [
                            ["role" => "user", "content" => $prompt]
                        ],
                        'temperature' => 0.7
                    ]);

                    if ($response->successful()) {
                        $design->details = $response->json()['choices'][0]['message']['content'];
                        unset($design->imageUrl);
                        $design->save();
                        $this->info("Updated details for design ID {$design->id}");
                    } else {
                        // Extracting the error message from the response
                        $errorMessage = $response->json()['error']['message'] ?? 'Unknown error';
                        $this->error("Failed to update design ID {$design->id}. Error: {$errorMessage}");

                        // Reconstructing the raw request body for display
                        $requestBody = json_encode([
                            'model' => 'gpt-3.5-turbo',
                            'messages' => [
                                ["role" => "user", "content" => $prompt]
                            ],
                            'temperature' => 0.7
                        ], JSON_PRETTY_PRINT);

                        $this->line("Request Body: " . $requestBody);
                    }
                } else {
                    $this->error("Design ID {$id} does not have an image URL.");
                }
            } else {
                $this->error("Design ID {$id} not found or already has details.");
            }

            $this->info('Design details update attempt complete.');
    }

    public function updateAll() {
            $this->info("Updating details for all designs...");
            $designs = Design::whereNull('details')->get();
            foreach ($designs as $design) {
                $this->info("Updating details for design ID {$design->id} ($design->title)...");
                $formattedFloor = [];
                foreach ($design->floorsList as $floors) {
                    foreach ($floors as $propKey => $propVal) {
                        $formattedFloor[] = Translator::translate($propKey) . ': ' . $propVal;
                    }
                }
                
                $floors = implode(', ', $formattedFloor);
                $prompt = "Please give me a description in Russian of around 100-150 characters about this house plan. It's area is {$design->size} and here is a php implode of the array of rooms it has {$floors}. Description should be styled for a sales channel such as a website";

                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer '  . config('services.openai.api_key')
                ])->post('https://api.openai.com/v1/chat/completions', [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => [
                        ["role" => "user", "content" => $prompt]
                    ],
                    'temperature' => 0.7
                ]);

                if ($response->successful()) {
                    $design->details = $response->json()['choices'][0]['message']['content'];
                    $design->save();
                    $this->info("Nice! :)");
                } else {
                    // Extracting the error message from the response
                    $errorMessage = $response->json()['error']['message'] ?? 'Unknown error';
                    $this->error("Failed to update design ID {$design->id}. Error: {$errorMessage}");

                    // Reconstructing the raw request body for display
                    $requestBody = json_encode([
                        'model' => 'gpt-3.5-turbo',
                        'messages' => [
                            ["role" => "user", "content" => $prompt]
                        ],
                        'temperature' => 0.7
                    ], JSON_PRETTY_PRINT);

                    $this->line("Request Body: " . $requestBody);
                }
            }
    }
}