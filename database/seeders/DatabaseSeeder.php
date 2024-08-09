<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Execute o arquivo SQL para criar as tabelas
        $createTablesPath = base_path('database/create-tables.sql');
        $createTablesSql = file_get_contents($createTablesPath);
        DB::unprepared($createTablesSql);

        // Execute o arquivo SQL para popular dados
        $populateDataPath = base_path('database/populate-tables.sql');
        $populateDataSql = file_get_contents($populateDataPath);
        DB::unprepared($populateDataSql);

        $this->command->info('Database seeded!');
    }
}
