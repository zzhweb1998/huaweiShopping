<template>
    <div id="ordersDetailed">
        <div class="ac-header">
            订单编号{{ordersNo}}的详情信息
            <button @click="returnLast">返回</button>
        </div>
        <div class="od-top">
            <div class="od-address">
                <p>
                    <span>订单地址</span>
                </p>
                <p>
                    <span>收件人：{{ordersInfo.user_name}}</span>
                    &nbsp;&nbsp;
                    <span>联系方式：{{ordersInfo.user_phone}}</span>
                    &nbsp;&nbsp;
                    <span>邮编：{{ordersInfo.address_zip}}</span>
                </p>
                <p>详细地址：{{ordersInfo.address_province}} {{ordersInfo.address_city}} {{ordersInfo.address_district}} {{ordersInfo.address_detailed}}</p>
            </div>
            <div class="od-process">
                <p>
                    <span>订单流程</span>
                    <span>订单状态：</span>
                </p>
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
                ordersInfo:'',
                ordersNo:''
            }
        },
        created(){
            this.ordersNo = this.$route.query.ordersno
            console.log(this.ordersNo);
            
            this.axios.post("/api/shop/selectOD",{
                no: this.ordersNo
            }).then(res => {
                this.ordersInfo = res.data[0]
                console.log(this.ordersInfo);
                
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
    .ac-header>button{
        float: right;
        width: 80px;
        height: 40px;
        font-size: 18px;
        color: #333;
        margin-top: 10px;
        margin-right: 150px;
    }
    .od-top{
        width: 86%;
        height: 150px;
        margin: 0px auto;
        border: 1px solid #333;
    }
    .od-buttom{
        width: 86%;
        height: 400px;
        margin: 0px auto;
        border: 1px solid #333;
    }
    .od-address{
        float: left;
        width: 700px;
        height: 100%;
        border: 1px solid #333;
    }
    .od-process{
        float: left;
        width: 404px;
        height: 100%;
        overflow: hidden;
        overflow-y: scroll;
        border: 1px solid #333;
    }
    .od-goods{
        float: left;
        width: 700px;
        height: 100%;
        border: 1px solid #333;
    }
    .od-status{
        float: left;
        width: 404px;
        height: 100%;
        border: 1px solid #333;
    }
    .od-address>p{
        font-size: 20px;
        margin-left: 30px;
        margin-top: 10px;
        color: #555;
    }
    .od-address>p:nth-of-type(1)>span{
        font-size: 21px;
        font-weight: 600;
    }
    .od-process>p{
        margin-top: 10px;
    }
    .od-process>p:nth-of-type(1) span{
        font-size: 18px;
        color: #333;
        margin-left: 20px;
    }
    .od-process>p:nth-of-type(1) span:nth-of-type(2){
        margin-left: 100px;
    }
</style>