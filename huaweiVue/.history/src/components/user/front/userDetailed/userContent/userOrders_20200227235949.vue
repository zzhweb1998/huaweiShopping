<template>
    <div id="userOrders">
        <div class="uo-title">我的订单</div>
        <div class="uo-select">
            <div v-for="(sel,index) in selInfo" :key="index" :class="{'selKey':sel.no == selIndex}">{{sel.name}}</div>
        </div>
        <div class="uo-content">

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
        padding: 0 10px;
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
</style>