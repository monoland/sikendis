<?php

use Illuminate\Database\Seeder;
use App\Models\Authent;

class AuthentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Authent::create(['name' => 'administrator']);
        Authent::create(['name' => 'operator']);
        Authent::create(['name' => 'kabiro']);
        Authent::create(['name' => 'pptk']);
        Authent::create(['name' => 'kpa']);
        Authent::create(['name' => 'bengkel']);
        Authent::create(['name' => 'tata-usaha']);
    }
}
