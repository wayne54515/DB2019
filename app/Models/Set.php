<?php

namespace App\Models;

use App\Models\BaseModel;

class Set extends BaseModel
{
    protected $table = 'set';
    protected $fillable = [
        'id', 'dish_id', 'dish_num', 'desert_id', 'desert_num', 'beverage_id', 'beverage_num'
    ];
}