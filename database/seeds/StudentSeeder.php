<?php

use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Student seeder
        // How many students you need, defaulting to 1-
        $count = (int)$this->command->ask('How many students do you need ?', 10);

        $this->command->info("Creating {$count} students.");

        // Create the students
        factory(App\Student::class, $count)->create();

        $this->command->info('Students Created!');

        // Attendace seeder
        // How many attendances you need, defaulting to 4
        $count = (int)$this->command->ask('How many attendances do you need ?', 4);

        $this->command->info("Creating {$count} attendances.");

        // Create the attendances
        factory(App\Attendance::class, $count)->create();

        $this->command->info('Attendances Created!');

        // Get all the attendances attaching up to 3 random attendances to each student
        $attendances = App\Attendance::all();

        // Populate the pivot table
        App\Student::all()->each(function ($student) use ($attendances) {
            $student->attendances()->attach(
                $attendances->random(3)->pluck('id')->toArray()
            );
        });
    }
}
