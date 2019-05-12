<?php

namespace App\Models;

use App\Models\BaseModel;

class Cook extends BaseModel
{
    protected $table = 'cook';
    protected $fillable = [
        'id', 'cook_id', 'salary'
    ];
}