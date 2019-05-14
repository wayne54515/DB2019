<?php

use Illuminate\Database\Seeder;

class RankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = 'database/seeds/sql_data/fake_rank.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('rank table seeded!');
    }
}
