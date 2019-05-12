<?php

namespace App\Models;

use App\Models\BaseModel;

class Dish extends BaseModel
{
    protected $table = 'dish';
    protected $fillable = [
        'id', 'dish_id', 'spice'
    ];
}