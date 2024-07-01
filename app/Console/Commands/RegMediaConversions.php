<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use App\Models\Design;

class RegenerateMediaConversions extends Command
{
    protected $signature = 'media:regenerate';
    protected $description = 'Regenerate conversions for all media attached to Design models';

    public function handle()
    {
        $designs = Design::has('media')->get();

        $this->info("Found {$designs->count()} Design models with media.");

        $bar = $this->output->createProgressBar($designs->count());

        foreach ($designs as $design) {
            $this->info("\nProcessing Design id: {$design->id}");
            
            foreach ($design->getMedia() as $media) {
                $this->info("Processing media id: {$media->id}");
                
                // Re-register media conversions
                $design->registerMediaConversions($media);
                
                // Regenerate conversions
                $media->clearMediaCollectionExcept('images', $media);
                $media->save();
                
                $this->info("Conversions regenerated for media id: {$media->id}");
            }
            
            $bar->advance();
        }

        $bar->finish();
        $this->info("\nAll conversions for Design media have been queued for regeneration.");
    }
}