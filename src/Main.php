<?php

namespace Astamatech\LaravelAutoseed;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AutoSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tableName = $this->ask('Please specify the name of the table to seed');

        if (!DB::table($tableName)->exists()) {
            $this->command->error("Table '{$tableName}' does not exist.");
            return;
        }

        $data = DB::table($tableName)->get()->toArray();

        // Ganti 'ModelName' dengan nama model yang sesuai dengan tabel Anda
        foreach ($data as $row) {
            \App\Models\ModelName::create((array) $row);
        }

        $this->command->info("Data seeded from '{$tableName}' table successfully.");
    }
}
