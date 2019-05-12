<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cook extends BaseModel
{
    protected $fillable = [
        'id', 'cook_id', 'salary'
    ];
}