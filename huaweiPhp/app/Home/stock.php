<?php

namespace App\Home;

use Illuminate\Database\Eloquent\Model;

class stock extends Model
{
    //商品库存表
    //定义模型关联的数据表（一个模型只操作一张表）
    protected $table = 'stock';
    //定义禁止操作时间
    public $timestamps = false; 
}
