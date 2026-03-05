<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportStudents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-students {path?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path = $this->argument('path') ?? 'import.xlsx';
        if (!file_exists($path)) {
            $this->error("File $path not found.");
            return 1;
        }

        try {
            \Maatwebsite\Excel\Facades\Excel::import(new \App\Imports\StudentsImport, $path);
            $this->info('Import completed.');
        } catch (\Exception $e) {
            $this->error('Import failed: ' . $e->getMessage());
            return 1;
        }
        return 0;
    }
}
