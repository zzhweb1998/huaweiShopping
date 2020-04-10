<template>
    <div id="userOrders">
        <div class="uo-title">我的订单</div>
        <div class="uo-select">
            
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
                    }
                ]
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
</style>