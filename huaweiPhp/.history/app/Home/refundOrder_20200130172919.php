<?php

namespace App\Home;

use Illuminate\Database\Eloquent\Model;

class refundOrder extends Model
{
    //退货订单详细信息
    //定义模型关联的数据表（一个模型只操作一张表）
    protected $table = 'refund_order';
    //定义禁止操作时间
    public $timestamps = false; 
}
