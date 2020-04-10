<?php

namespace App\Home;

use Illuminate\Database\Eloquent\Model;

class refund extends Model
{
    //退货订单信息
    //定义模型关联的数据表（一个模型只操作一张表）
    protected $table = 'refund';
    //定义禁止操作时间
    public $timestamps = false; 
}
