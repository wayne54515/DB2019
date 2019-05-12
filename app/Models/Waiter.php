<?php

namespace App\Models;

use App\Models\BaseModel;

class Waiter extends BaseModel
{
    protected $table = 'waiter';
    protected $fillable = [
        'id', 'waiter_id', 'salary'
    ];
}