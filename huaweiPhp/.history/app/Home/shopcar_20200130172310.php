<?php

namespace App\Home;

use Illuminate\Database\Eloquent\Model;

class shopcar extends Model
{
    //购物车商品基本信息
    //定义模型关联的数据表（一个模型只操作一张表）
    protected $table = 'shopcar';
    //定义禁止操作时间
    public $timestamps = false; 
}
