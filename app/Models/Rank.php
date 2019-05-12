<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rank extends BaseModel
{
    protected $fillable = [
        'id', 'food_id', 'user_id', 'rank'
    ];
}