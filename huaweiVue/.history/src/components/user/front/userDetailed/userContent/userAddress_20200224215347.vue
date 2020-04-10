<template>
    <div id="userAddress">
        <div class="addressTitle">收货地址管理</div>
        <div class="addressOperate">
            <div>
                <span>收货人：</span>
                <input type="text">
            </div>
            <div>
                <span>手机号码：</span>
            </div>
            <div>
                <span>收货地址：</span>
            </div>
            <div>
                <span>邮编：</span>
            </div>
        </div>
        <div class="addressBox">

        </div>
    </div>
</template>


<style>
    #userAddress{
        width: 100%;
        height: 100%;
        border: 1px solid #333;
    }
    .addressTitle{
        width: 100%;
        height: 50px;
        line-height: 50px;
        font-size: 22px;
        text-indent: 30px;
        background: #eee;
    }
    .addressOperate{
        width: 100%;
        height: 300px;
        margin-top: 10px;
        border: 1px solid #333;
    }
    .addressOperate>div{
        width: 100%;
        height: auto;
        font-size: 20px;
        color: #555;
        margin-top: 10px;
        border: 1px solid #333;
    }
    .addressOperate>div>span{
        display: inline-block;
        width: 150px;
        text-align: right;
    }
</style>