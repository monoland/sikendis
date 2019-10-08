<?php

use App\Imports\ItemsImport;
use Illuminate\Database\Seeder;
use Maatwebsite\Excel\Facades\Excel;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Excel::import(new ItemsImport(), storage_path('seeds'.DIRECTORY_SEPARATOR.'items.xlsx'));
    }
}
