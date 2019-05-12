<?php

namespace App\Models;

use App\Models\BaseModel;

class Trade extends BaseModel
{
    public $timestamps = true;
    protected $table = 'trade';
    protected $fillable = [
        'id', 'food_id', 'table_id', 'number', 'created_at'
    ];
}