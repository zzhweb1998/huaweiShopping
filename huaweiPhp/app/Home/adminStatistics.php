<?php

namespace App\Home;

use Illuminate\Database\Eloquent\Model;

class adminStatistics extends Model
{
    //用户地址信息
    //定义模型关联的数据表（一个模型只操作一张表）
    protected $table = 'admin_statistics';
    //定义禁止操作时间
    public $timestamps = false;
}
