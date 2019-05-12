<?php

namespace App\Models;

use App\Models\BaseModel;

class Table extends BaseModel
{
    protected $table = 'table';
    protected $fillable = [
        'id', 'table_id', 'waiter_id', 'user_id', 'capacity', 'created_at'
    ];
}