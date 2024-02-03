<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class DatabaseBackupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:backup';
    protected $description = 'Backup the database';

    public function handle()
    {
        $this->info('Starting remote database backup...');

        $dbUsername = env('DB_USERNAME', 'your_db_username');
        $dbName = env('DB_DATABASE', 'your_db_name');
        $dbHost = env('DB_HOST', 'your_db_host');
        $dbPort = env('DB_PORT', 3306); // Default MySQL port
        $backupPath = storage_path('backups/' . date('Y-m-d_His') . '_backup.sql');

        $command = "mysqldump --set-gtid-purged=OFF -h{$dbHost} -P{$dbPort} -u{$dbUsername} -p {$dbName} > {$backupPath}";

        $process = Process::fromShellCommandline($command);
        try {
            $process->mustRun();
            $this->info('Remote database backup completed successfully.');
        } catch (ProcessFailedException $exception) {
            $this->error('Remote database backup failed: ' . $exception->getMessage());
        }
    }
}
