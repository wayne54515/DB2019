<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends BaseModel
{
    protected $fillable = [
        'id', 'table_id', 'waiter_id', 'user_id', 'capacity', 'created_at'
    ];
}