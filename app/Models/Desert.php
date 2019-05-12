<?php

namespace App\Models;

use App\Models\BaseModel;

class Desert extends BaseModel
{
    protected $table = 'desert';
    protected $fillable = [
        'id', 'desert_id', 'taste'
    ];
}