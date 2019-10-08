<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call(AuthentsTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(AgenciesTableSeeder::class);
        $this->call(SegmentsTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
