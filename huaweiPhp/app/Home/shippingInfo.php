<?php

namespace App\Home;

use Illuminate\Database\Eloquent\Model;

class shippingInfo extends Model
{
    //物流订单详细信息
    //定义模型关联的数据表（一个模型只操作一张表）
    protected $table = 'shippinginfo';
    //定义禁止操作时间
    public $timestamps = false; 
}
