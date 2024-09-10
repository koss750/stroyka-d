<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ProcessNewTemplate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:full-reindex';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Full reindex';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Artisan::call('cache:clear');
        Artisan::call('app:structures');
        Artisan::call('app:full');
        Artisan::call('app:full --defaultOnly');
    }
}
