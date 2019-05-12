<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends BaseModel
{
    protected $fillable = [
        'id', 'name', 'sex', 'birthday', 'work_time', 'type'
    ];
}