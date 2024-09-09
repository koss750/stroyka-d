<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Project;
use Carbon\Carbon;

class CleanupOldOrders extends Command
{
    protected $signature = 'orders:cleanup';
    protected $description = 'Remove orders without a filename or those created over 12 hours ago';

    public function handle()
    {
        $cutoffTime = Carbon::now()->subHours(12);

        $deletedCount = Project::where(function ($query) use ($cutoffTime) {
            $query->whereNull('filepath')
                  ->orWhere('created_at', '<', $cutoffTime);
        })->delete();

        $this->info("Deleted {$deletedCount} old or incomplete orders.");
    }
}