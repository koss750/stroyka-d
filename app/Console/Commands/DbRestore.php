<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class DbRestore extends Command
{
    protected $signature = 'db:restore {backupFile?}';
    protected $description = 'Restore the database from a backup file';

    public function handle()
    {
        $databaseName = env('DB_DATABASE');
        $userName = "root";
        $password = $this->ask('Please enter MySQL Root user password');

        $backupFile = $this->argument('backupFile') ?? $this->chooseBackupFile();

        

        if (!$backupFile || !File::exists(storage_path('backups/' . $backupFile))) {
            $this->error("$backupFile file does not exist.");
            return;
        }
        
        $backupFile = storage_path('backups/' . $backupFile);

        // Drop and recreate the database
        DB::statement("DROP DATABASE IF EXISTS {$databaseName}");
        DB::statement("CREATE DATABASE {$databaseName}");

        // Import the backup file
        $command = sprintf('mysql -u %s -p%s %s < %s',
            $userName, $password, $databaseName, $backupFile);

        $process = Process::fromShellCommandline($command);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $this->info('Database restored successfully from ' . $backupFile);
    }

    protected function chooseBackupFile()
    {
        $files = File::files(storage_path('backups'));
        $fileNames = array_map(function ($file) {
            return $file->getFilename();
        }, $files);

        return $this->choice('Select a backup file', $fileNames, 0);
    }
}