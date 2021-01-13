<?php

use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Class seeder
        // How many classes you need, defaulting to 1
        $count = (int)$this->command->ask('How many classes do you need ?', 1);

        $this->command->info("Creating {$count} classes.");

        // Create the classes
        factory(App\Classe::class, $count)->create();

        $this->command->info('Classes Created!');
    }
}
