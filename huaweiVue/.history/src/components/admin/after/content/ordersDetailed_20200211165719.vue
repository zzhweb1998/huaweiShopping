<template>
    <div id="ordersDetailed">
        <div class="ac-header">
            订单详情
            <button @click="returnLast">返回</button>
        </div>
        <div class="od-top">
            <div class="od-address">
                <p>订单地址</p>
            </div>
            <div class="od-process">

            </div>
        </div>
        <div class="od-buttom">
            <div class="od-goods">

            </div>
            <div class="od-status">

            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                ordersDetailed:''
            }
        },
        created(){
            this.axios.post("/api/shop/ordersDetailed").then(res => {
                this.axios
            })
        },
        methods:{
            returnLast(){
                this.$router.go(-1)
            },
        }
    }
</script>

<style>
    #ordersDetailed{
        width: 100%;
        height: 100%;
    }
    .ac-header{
        width: 100%;
        height: 60px;
        background: #eee;
        font-size: 26px;
        font-weight: 600;
        line-height: 60px;
        text-indent: 100px;
        color: #555;
    }
    .od-top{
        width: 100%;
        height: 180px;
        border: 1px solid #333;
    }
    .od-buttom{
        width: 100%;
        height: 400px;
        border: 1px solid #333;
    }
    .od-address{
        float: left;
        width: 800px;
        height: 100%;
        border: 1px solid #333;
    }
    .od-process{
        float: left;
        width: 480px;
        height: 100%;
        border: 1px solid #333;
    }
    .od-goods{
        float: left;
        width: 800px;
        height: 100%;
        border: 1px solid #333;
    }
    .od-status{
        float: left;
        width: 480px;
        height: 100%;
        border: 1px solid #333;
    }
</style>