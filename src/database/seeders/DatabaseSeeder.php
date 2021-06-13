<?php

namespace Database\Seeders;

class DatabaseSeeder extends \Illuminate\Database\Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(InstrumentTypeSeeder::class);
        // $this->call(ModelYearSeeder::class);
        // $this->call(ModelSeeder::class);
        // $this->call(MarkSeeder::class);
        // $this->call(InstrumentSeeder::class);
    }
}
