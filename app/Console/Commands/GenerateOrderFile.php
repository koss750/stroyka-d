<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\GenerateOrderFileJob;

class GenerateOrderFile extends Command
{
    protected $signature = 'order:generate {projectId}';
    protected $description = 'Generate an order file for a given project and design';

    public function handle()
    {
        $projectId = $this->argument('projectId');

        $this->info("Dispatching job to generate order file for Project ID: $projectId");

        GenerateOrderFileJob::dispatch($projectId);

        $this->info('Job dispatched successfully. The order file will be generated in the background.');
    }
}
