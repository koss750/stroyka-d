<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Design;
use Illuminate\Support\Facades\Http;

class UpdateDesignDetails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'design:details';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Use AI to update descriptions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $designs = Design::all();

        foreach ($designs as $design) {
            // Check if 'details' is empty and 'image_url' is set
            if (empty($design->details) && $design->setImages($design)) {
                $prompt = "Please give me a description of around 100-150 characters about this house plan. It looks like {$design->image_url}, it's area is {$design->size} and here is a description of all its rooms {$design->floorsList}";

                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer'  . config('services.openai.api_key')
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
                    $this->info("Updated details for design ID {$design->id}");
                } else {
                    $this->error("Failed to update design ID {$design->id}");
                }
            }
        }

        $this->info('Design details update complete.');
    }
}
