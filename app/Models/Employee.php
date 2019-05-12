<?php

namespace App\Models;

use App\Models\BaseModel;

class Employee extends BaseModel
{
    protected $table = 'employee';
    protected $fillable = [
        'id', 'name', 'sex', 'birthday', 'work_time', 'type'
    ];
}