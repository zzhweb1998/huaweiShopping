<?php

namespace App\Home;

use Illuminate\Database\Eloquent\Model;

class user extends Model
{
    //用户表（用户和管理员）
    //定义模型关联的数据表（一个模型只操作一张表）
    protected $table = 'user';
    //定义禁止操作时间
    public $timestamps = false;  
}
