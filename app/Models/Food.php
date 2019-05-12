<?php

namespace App\Models;

use App\Models\BaseModel;

class Food extends BaseModel
{
    protected $table = 'food';
    protected $fillable = [
        'id', 'name', 'price', 'type'
    ];
    //example
    // protected $fillable = [
    //     'id', 'name', 'attribute'
    // ];

    // /**
    //  * 取得  模型
    //  *
    //  * @return App\Models\
    //  */
    // public function (){
    //     return $this->hasOne('App\Models\', 'id', '_id');
    // }

    // /**
    //  * 取得  模型
    //  * 
    //  * @return App\Models\
    //  */
    // public function (){
    //     return $this->hasMany('App\Models\', '_id', 'id');
    // }
}