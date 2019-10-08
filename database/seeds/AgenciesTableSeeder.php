<?php

use App\Imports\AgenciesImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class AgenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Excel::import(new AgenciesImport(), storage_path('seeds'.DIRECTORY_SEPARATOR.'agencies.xlsx'));
    }
}
