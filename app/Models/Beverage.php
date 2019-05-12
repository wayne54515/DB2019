<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Beverage extends BaseModel
{
    protected $fillable = [
        'id', 'beverage_id', 'ice', 'sweet'
    ];
}