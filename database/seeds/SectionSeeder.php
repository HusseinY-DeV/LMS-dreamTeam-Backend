<?php

use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Section seeder
        // How many sections you need, defaulting to 2
        $count = (int)$this->command->ask('How many sections do you need ?', 2);

        $this->command->info("Creating {$count} sections.");

        // Create the sections
        factory(App\Section::class, $count)->create();

        $this->command->info('Sections Created!');

        // Attendace seeder
        // How many attendances you need, defaulting to 4
        $count = (int)$this->command->ask('How many attendances do you need ?', 4);

        $this->command->info("Creating {$count} attendances.");
    }
}
