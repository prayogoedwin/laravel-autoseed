<?php

namespace Astamatech\LaravelAutoseed;

use Illuminate\Console\Command;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AutoSeed extends Seeder
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'db:seed-table';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed data from a specified table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tableName = $this->option('table');
        
        if (!$tableName) {
            $tableName = $this->ask('Please specify the name of the table to seed');
        }
        
        if (!DB::table($tableName)->exists()) {
            $this->error("Table '{$tableName}' does not exist.");
            return 1;
        }

        // Convert table name to model name (singular)
        $modelName = ucfirst(str_singular($tableName));

        // Check if model class exists
        if (!class_exists("App\Models\\$modelName")) {
            $this->error("Model '$modelName' does not exist.");
            return 1;
        }

        $data = DB::table($tableName)->get()->toArray();

        // Create model instances using dynamic class name
        foreach ($data as $row) {
            $modelClass = "App\Models\\$modelName";
            $modelClass::create((array) $row);
        }

        $this->info("Data seeded from '{$tableName}' table using '$modelName' model successfully.");

        return 0;
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['table', null, InputOption::VALUE_OPTIONAL, 'The name of the table to seed'],
        ];
    }
}