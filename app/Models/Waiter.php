<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Waiter extends BaseModel
{
    protected $fillable = [
        'id', 'waiter_id', 'salary'
    ];
}