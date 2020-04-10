<?php

namespace App\Home;

use Illuminate\Database\Eloquent\Model;

class shopcarInfo extends Model
{
    //购物车商品详情信息（包括商品图片信息）
    //定义模型关联的数据表（一个模型只操作一张表）
    protected $table = 'shopcarinfo';
    //定义禁止操作时间
    public $timestamps = false; 
}
