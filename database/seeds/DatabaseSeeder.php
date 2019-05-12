<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminAccountSeeder::class);
        $this->call(FoodSeeder::class);
        $this->call(RankSeeder::class);

    }
}
