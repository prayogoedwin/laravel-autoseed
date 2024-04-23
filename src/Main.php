<?php

namespace Astamatech\LaravelAutoseed;

use Illuminate\Console\Command;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\InputOption;

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
            $this->error('Please specify the name of the table using the --table option.');
            return 1;
        }
        
        if (!DB::table($tableName)->exists()) {
            $this->error("Table '{$tableName}' does not exist.");
            return 1;
        }

        $data = DB::table($tableName)->get()->toArray();

        foreach ($data as $row) {
            \App\Models\ModelName::create((array) $row);
        }

        $this->info("Data seeded from '{$tableName}' table successfully.");

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
            ['table', null, InputOption::VALUE_REQUIRED, 'The name of the table to seed'],
        ];
    }
}

?>