<?php

use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $food_list = ['蛋包飯', '香草冰淇淋', '紅茶'];
        $food_type = ['dish', 'desert', 'beverage'];
        $i = 0;
        for($i=0 ; $i<3 ; $i++){
            $food = App\Models\Food::create([
                'name' => $food_list[$i],
                'price' => 70-($i*20),
                'type' => $food_type[$i]
            ]);
    
            DB::transaction(function () use ($food) {
                $food->save();
            });
        }
        
    }
}
