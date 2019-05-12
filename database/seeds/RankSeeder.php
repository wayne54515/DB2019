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
        for($i=0 ; $i<3 ; $i++){
            $rank = App\Models\Rank::create([
                'food_id' => ($i+1),
                'user_id' => 1,
                'rank' => 8-$i,
            ]);
    
            DB::transaction(function () use ($rank) {
                $rank->save();
            });
        }
    }
}
