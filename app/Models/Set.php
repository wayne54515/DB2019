<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Set extends BaseModel
{
    protected $fillable = [
        'id', 'dish_id', 'dish_num', 'desert_id', 'desert_num', 'beverage_id', 'beverage_num'
    ];
}