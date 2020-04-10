<template>
    <div id="userOrders">
        <div class="uo-title">我的订单</div>
        <div class="uo-select">
            <div v-for="(sel,index) in selInfo" :key="index" :class="{'selKey':sel.no == selIndex}" 
            @click="selScreen(sel.no)">{{sel.name}}</div>
        </div>
        <div class="uo-content">
            <div class="uo-header">
                <div>商品</div>
                <div>单价</div>
                <div>数量</div>
                <div>实付金额</div>
                <div>状态/操作</div>
            </div>
            <div class="uo-info">
                <div class="uo-box">
                    <div class="ordersHeader">
                        <p>{{}}</p>
                        <p>{{}}</p>
                    </div>
                    <div class="orders-goods">
                        <img src="" alt="">
                        <div class="og-info"></div>
                        <div class="og-price">{{}}</div>
                        <div class="og-num">{{}}</div>
                    </div>
                    <div class="orders-price">{{}}</div>
                    <div class="orders-operate"></div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                selInfo: [
                    {
                        no:1,
                        name: '全部有效订单'
                    },
                    {
                        no:2,
                        name: '待付款'
                    },
                    {
                        no:3,
                        name: '待发货'
                    },
                    {
                        no:4,
                        name: '待收货'
                    },
                    {
                        no:5,
                        name: '已完成'
                    },
                    {
                        no:6,
                        name: '已取消'
                    },
                ],
                selIndex: 1,
            }
        },
        created(){

        },
        methods:{
            selScreen(no){
                if(this.selIndex != no){
                    this.selIndex = no
                }
            }
        }
    }
</script>

<style>
    #userOrders{
        width: 100%;
        height: 100%;
        border: 1px solid #333;
    }
    .uo-title{
        width: 100%;
        height: 50px;
        font-size: 24px;
        color: #333;
        line-height: 50px;
        text-indent: 20px;
        border-bottom: 1px solid #ccc;
    }
    .uo-select{
        width: 100%;
        height: 50px;
    }
    .uo-select>div{
        float: left;
        margin-top: 10px;
        height: 30px;
        padding: 0 15px;
        line-height: 30px;
        margin-left: 10px;
        color: #777;
        cursor: pointer;
        background: #eee;
    }
    .uo-select>div:hover{
        color: #f9f9f9;
        background: #333;
    }
    .uo-select>.selKey{
        color: #f9f9f9;
        background: #333;
    }
    .uo-content{
        width: 100%;
        height: 430px;
        margin-top: 10px;
        overflow: hidden;
        overflow-y: scroll;
        border: 1px solid #333;
    }
    .uo-header{
        width: 100%;
        height: 40px;
        background: #f9f9f9;
    }
    .uo-header>div{
        float: left;
        height: 25px;
        text-align: center;
        margin-top: 8px;
        line-height: 25px;
        font-size: 16px;
        color: #777;
    }
    .uo-header>div:nth-of-type(n+2){
        border-left: 1px solid #ccc;
    }
    .uo-header>div:nth-of-type(1){
        width: 44%;
    }
    .uo-header>div:nth-of-type(2){
        width: 14%;
    }
    .uo-header>div:nth-of-type(3){
        width: 14%;
    }
    .uo-header>div:nth-of-type(4){
        width: 14%;
    }
    .uo-header>div:nth-of-type(5){
        width: 14%;
    }
    .uo-info{
        width: 100%;
    }
    .uo-box{
        width: 100%;
        height: 160px;
        border: 1px solid #333;
    }
    .ordersHeader{
        width: 100%;
        height: 40px;
        font-size: 18px;
        color: #555;
        line-height: 40px;
        border: 1px solid #ccc;
    }
    .ordersHeader>p:nth-of-type(1){
        float: left;
        margin-left: 10px;
    }
    .ordersHeader>p:nth-of-type(2){
        float: right;
        margin-right: 10px;
    }
    .orders-goods{
        float: left;
        clear: both;
        width: 73%;
        height: 120px;
        margin-left: 0px;
        overflow: hidden;
        overflow-y: scroll;
        border: 1px solid #333;
    }
    .orders-goods>img{
        display: block;
        float: left;
        width: 120px;
        height: 120px;
        border: 1px solid #333;
    }
    .og-info{
        float: left;
        width: 323px;
        height: 100%;
        border: 1px solid #333;
    }
    .og-price,.og-num{
        float: left;
        width: 140px;
        height: 100%;
        text-align: center;
        line-height: 50px;
        color: #777;
        border: 1px solid #333;
    }
    .orders-price{
        float: left;
        width: 130px;
        height: 120px;
        text-align: center;
        line-height: 50px;
        color: #777;
        border: 1px solid #333;
    }
</style>