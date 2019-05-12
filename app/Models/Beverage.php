<?php

namespace App\Models;

use App\Models\BaseModel;

class Beverage extends BaseModel
{
    protected $fillable = [
        'id', 'beverage_id', 'ice', 'sweet'
    ];
}