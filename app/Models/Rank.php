<?php

namespace App\Models;

use App\Models\BaseModel;

class Rank extends BaseModel
{
    protected $table = 'rank';
    protected $fillable = [
        'id', 'food_id', 'user_id', 'rank'
    ];

    /**
     * 取得  User 模型
     *
     * @return App\Models\User
     */
    public function user(){
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    /**
     * 取得  User 模型
     *
     * @return App\Models\User
     */
    public function food(){
        return $this->hasOne('App\Models\Food', 'id', 'food_id');
    }
}