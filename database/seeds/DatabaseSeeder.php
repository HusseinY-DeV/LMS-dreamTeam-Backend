<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(ClassSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(AttendanceSeeder::class);
        $this->command->info("Database seeded.");
    }
}
