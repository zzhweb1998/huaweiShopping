<template>
    <div id="userSelect">
        <ul>
            <li>
                <span>用户信息</span>
                <span>></span>
            </li>
            <li>
                <span>用户地址</span>
                <span>></span>
            </li>
            <li>
                <span>购物车信息</span>
                <span>></span>
            </li>
            <li>
                <span>订单信息</span>
                <span>></span>
            </li>
        </ul>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                selectInfo:[
                    {
                        no:1,
                        name:'基本信息'
                    },
                    {
                        no:2,
                        name:'送货地址'
                    },
                    {
                        no:3,
                        name:'我的购物车'
                    },
                    {
                        no:4,
                        name:'我的订单'
                    },
                ]
            }
        }
    }
</script>

<style>
    #userSelect{
        width: 250px;
        height: 100%;
        float: left;
        border: 1px solid #333;
    }
    #userSelect ul{
        width: 100%;
        height: 90%;
        margin-top: 20px;
    }
    #userSelect li{
        list-style-type: none;
        width: 200px;
        height: 40px;
        margin: 10px auto;
        font-size: 20px;
        text-align: center;
        line-height: 40px;
        color: #333;
        cursor: pointer;
        border: 1px solid #333;
    }
    #userSelect li>span:nth-of-type(2){
        float: right;
        margin-right: 30px;
    }
</style>