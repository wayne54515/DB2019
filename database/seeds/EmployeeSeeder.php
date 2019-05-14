<?php

use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = 'database/seeds/sql_data/fake_employee.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('employee table seeded!');
    }
}
