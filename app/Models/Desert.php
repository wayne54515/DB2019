<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Desert extends BaseModel
{
    protected $fillable = [
        'id', 'desert_id', 'taste'
    ];
}