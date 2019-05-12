<?php

namespace App\Models;

use App\Models\BaseModel;

class Trade extends BaseModel
{
    protected $table = 'trade';
    protected $fillable = [
        'id', 'food_id', 'user_id', 'number', 'created_at'
    ];
}