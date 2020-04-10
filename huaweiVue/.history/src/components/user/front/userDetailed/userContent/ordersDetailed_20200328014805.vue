<template>
    <div id="ordersDetailed">
        <div class="od-header">
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
                <p>详细地址：{{ordersInfo.address_province}} {{ordersInfo.address_city}} {{ordersInfo.address_district}}
                    {{ordersInfo.address_detailed}}</p>
            </div>
            <div class="od-process">
                <p>
                    <span>订单流程</span>
                    <span v-for="(sta,index) in status" :key="index"
                        v-if="sta.no == ordersInfo.orders_status">状态：{{sta.status}}</span>
                </p>
                <div v-if="ordersInfo.orders_status > 3">
                    <p>订单已签收</p>
                    <p>{{shippingInfo.receive_time}}</p>
                </div>
                <div v-if="ordersInfo.orders_status > 2">
                    <p>订单物流单号：{{shippingInfo.shipping_order_no}}</p>
                </div>
                <div v-if="ordersInfo.orders_status > 2">
                    <p>订单已发货</p>
                    <p>{{shippingInfo.shipping_time}}</p>
                </div>
                <div v-if="ordersInfo.orders_status == 2">
                    <p>订单已取消</p>
                </div>
                <div v-if="ordersInfo.orders_status > 0 && ordersInfo.pay_time != null">
                    <p>订单已付款</p>
                    <p>{{ordersInfo.pay_time}}</p>
                </div>
                <div v-if="ordersInfo.orders_status > 0 || ordersInfo.orders_status == 0">
                    <p>订单待付款</p>
                    <p>{{ordersInfo.create_time}}</p>
                </div>
            </div>
        </div>
        <div class="od-buttom">
            <div class="od-goods">
                <div class="goods-content" v-for="(og,index) in ordersGoods" :key="index">
                    <div>
                        <img :src=og.browse_picture_name alt="">
                    </div>
                    <div>
                        <p>{{og.goods_info_name}}</p>
                        <p>{{og.goods_info_title}}</p>
                        <p>
                            <span>颜色：{{og.goods_color}}</span>
                            &nbsp;&nbsp;&nbsp;
                            <span>配置：{{og.goods_configure}}</span>
                        </p>
                        <p>
                            <span>价格：{{og.goods_price}}</span>
                            &nbsp;&nbsp;&nbsp;
                            <span>数量：{{og.goods_num}}</span>
                        </p>
                    </div>
                    <div>
                        <p v-if="ordersInfo.orders_status == 0">待付款</p>
                        <p v-if="ordersInfo.orders_status == 1">待发货</p>
                        <p v-if="ordersInfo.orders_status == 2">已取消</p>
                        <p v-if="ordersInfo.orders_status == 3">待签收</p>
                        <p v-if="ordersInfo.orders_status == 4 && og.shopcar_status == 3">已签收</p>
                        <p v-if="ordersInfo.orders_status == 4 && og.shopcar_status == 6">退款失败</p>
                        <p v-if="ordersInfo.orders_status == 4 && og.shopcar_status == 8">退款成功</p>
                        <button v-if="ordersInfo.orders_status == 4 && (og.shopcar_status == 3 || og.shopcar_status == 6)" 
                        @click="applyRefund(ordersInfo.orders_no,og.goods_info_name,og.shopcar_id)">申请退款</button>
                        <button v-if="ordersInfo.orders_status == 4 && og.shopcar_status == 4" 
                        @click="cancelRefund(og.shopcar_id)">取消退货</button>
                    </div>
                </div>
            </div>
            <div class="od-status">
                <div>
                    <p>
                        <span>商品总金额：</span>
                        <span>￥{{ordersInfo.total_price}}</span>
                    </p>
                    <p>
                        <span>商品总数：</span>
                        <span>￥{{ordersInfo.total_num}}</span>
                    </p>
                    <p>
                        <span>运费：</span>
                        <span>￥0.00</span>
                    </p>
                    <p>
                        <span>优惠金额：</span>
                        <span>-￥{{(ordersInfo.orders_discount * 0.02 * ordersInfo.total_price).toFixed(2)}}</span>
                    </p>
                    <p>
                        <span>结算总金额：</span>
                        <span>￥{{(ordersInfo.total_price - (ordersInfo.orders_discount * 0.02 * ordersInfo.total_price)).toFixed(2)}}</span>
                    </p>
                </div>
                <button v-if="ordersInfo.orders_status == 0" @click="cutBan">立即付款</button>
                <button v-if="ordersInfo.orders_status < 2" @click="cancel">取消订单</button>
                <p v-if="ordersInfo.orders_status == 2">订单已取消</p>
                <p v-if="ordersInfo.orders_status == 3">已发货，待签收</p>
                <button v-if="ordersInfo.orders_status == 3" @click="signFor(ordersInfo.orders_no)">确认收货</button>
                <p v-if="ordersInfo.orders_status == 4">已签收，订单完成</p>
            </div>
        </div>
        <div class="refund-box" v-show="refundIf == 1">
            <div>
                <p>申请退货订单号：{{refundInfo.no}}</p>
                <p>退货商品：{{refundInfo.goods}}</p>
                <span>退货理由：</span>
                <textarea cols="40" rows="3" v-model='refundContent'></textarea>
                <br/>
                <button @click="refundOperate">申请退货</button>
                <button @click="exitRefund">取消</button>
            </div>
        </div>
        <div class="pageBan" v-show="banIf == 1">
            <div class="orderPay">
                <p>请输入支付密码</p>
                <div>
                    <span>支付密码：</span>
                    <input type="password">
                </div>
                <div>
                    <button @click="immediatelyPay(ordersInfo.orders_no,ordersInfo.total_price)">确认付款</button>
                    <button @click="cutBan">取消</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                ordersInfo: '',
                ordersNo: '',
                shippingInfo: '',
                ordersGoods: '',
                status: [
                    {
                        no: 0,
                        status: '待付款'
                    },
                    {
                        no: 1,
                        status: '已付款'
                    },
                    {
                        no: 2,
                        status: '已取消'
                    },
                    {
                        no: 3,
                        status: '已发货'
                    },
                    {
                        no: 4,
                        status: '已签收'
                    },
                ],
                refundInfo:{
                    no: 0,
                    goods: 'xxxx',
                    id: 0
                },
                refundIf: 0,
                refundContent:'',
                userAccount: '',
                userInfo: [],
                banIf: 0,
            }
        },
        created() {
            this.ordersNo = this.$route.query.ordersno
            this.axios.post("/api/shop/selectOD", {
                no: this.ordersNo
            }).then(res => {
                this.ordersInfo = res.data[0]
                if (this.ordersInfo.shipping_order_no != null) {
                    this.axios.post("/api/shop/selectShipping", {
                        no: this.ordersInfo.shipping_order_no
                    }).then(res => {
                        this.shippingInfo = res.data[0]
                    })
                }
                this.axios.post("/api/shop/ordersGoods", {
                    no: this.ordersNo
                }).then(res => {
                    this.ordersGoods = res.data
                    this.ordersGoods.filter((item, index) => {
                        this.ordersGoods[index].browse_picture_name = '../../../../../static/image/' + item.browse_picture_name
                    })
                })
            })
            this.userAccount = sessionStorage.getItem('account')
            this.axios.post("/api/shop/userInfo", {
                account: this.userAccount
            }).then(res => {
                this.userInfo = res.data[0]
                console.log(this.userInfo);
                
            })
        },
        methods: {
            returnLast() {
                this.$router.go(-1)
            },
            immediatelyPay(no, total) {
                if (this.payPassword == '' || this.payPassword == null) {
                    alert('请输入付款密码')
                } else if (this.payPassword != this.userInfo.user_pay) {
                    alert('付款密码有误请重新输入')
                    this.payPassword = ''
                } else if (this.userInfo.user_money < total) {
                    alert('用户余额不足，请充值余额')
                } else {
                    this.axios.post("/api/shop/ordersPay", {
                        no: no
                    }).then(res => {
                        if (res.data == 1) {
                            this.banIf = 0
                            this.refreshPage()
                        }
                    })
                }
            },
            cancel() {
                this.axios.post("/api/shop/cancelOrders", {
                    no: this.ordersNo
                }).then(res => {
                    if (res.data == 1) {
                        alert('订单取消成功')
                        this.$router.go(0)
                    } else {
                        alert('订单取消失败')
                    }
                })
            },
            signFor(no) {
                this.axios.post("/api/shop/signFor", {
                    no: no
                }).then(res => {
                    if (res.data == 1) {
                        alert('订单签收成功')
                        this.refreshPage()
                    } else {
                        alert('订单签收失败')
                    }
                })
            },
            applyRefund(no,name,id){
                this.refundInfo.no = no
                this.refundInfo.goods = name
                this.refundInfo.id = id
                this.refundIf = 1
            },
            exitRefund(){
                this.refundIf = 0
            },
            refundOperate(){
                if(this.refundContent == '' || this.refundContent == null){
                    alert('请填写申请退货理由')
                }else{
                    this.axios.post("/api/shop/applyRefund",{
                        id: this.refundInfo.id,
                        con: this.refundContent
                    }).then(res => {
                        if(res.data == 1){
                            alert('已申请退货成功')
                            this.refreshPage()
                            this.refundIf = 0
                        }else{
                            alert('申请退货失败')
                        }
                    })
                }
            },
            cancelRefund(id){
                this.axios.post("/api/shop/cancelRefund",{
                    id: id
                }).then(res => {
                    if(res.data == 1){
                        alert('取消退货成功')
                        this.refreshPage()
                    }else{
                        alert('取消退货失败')
                    }
                })
            },
            refreshPage() {
                this.axios.post("/api/shop/selectOD", {
                    no: this.ordersNo
                }).then(res => {
                    this.ordersInfo = res.data[0]
                    if (this.ordersInfo.shipping_order_no != null) {
                        this.axios.post("/api/shop/selectShipping", {
                            no: this.ordersInfo.shipping_order_no
                        }).then(res => {
                            this.shippingInfo = res.data[0]
                        })
                    }
                    this.axios.post("/api/shop/ordersGoods", {
                        no: this.ordersNo
                    }).then(res => {
                        this.ordersGoods = res.data
                        this.ordersGoods.filter((item, index) => {
                            this.ordersGoods[index].browse_picture_name = '../../../../../static/image/' + item.browse_picture_name
                        })
                    })
                })
            },
            cutBan(){
                if(this.banIf == 0){
                    this.banIf = 1
                }else{
                    this.banIf = 0
                }
            }
        }
    }
</script>

<style>
    #ordersDetailed {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .od-header {
        width: 100%;
        height: 60px;
        background: #eee;
        font-size: 26px;
        font-weight: 600;
        line-height: 60px;
        text-indent: 100px;
        color: #555;
    }

    .od-header>button {
        float: right;
        width: 80px;
        height: 40px;
        font-size: 18px;
        color: #333;
        margin-top: 10px;
        margin-right: 50px;
    }

    .od-top {
        width: 100%;
        height: 150px;
    }

    .od-buttom {
        width: 100%;
        height: 330px;
    }

    .od-address {
        float: left;
        width: 68%;
        height: 100%;
        border: 1px solid #ccc;
    }

    .od-process {
        float: left;
        width: 32%;
        height: 100%;
        overflow: hidden;
        overflow-y: scroll;
        border: 1px solid #ccc;
    }

    .od-goods {
        float: left;
        width: 68%;
        height: 100%;
        overflow: hidden;
        overflow-y: scroll;
        border: 1px solid #ccc;
    }

    .od-status {
        float: left;
        width: 32%;
        height: 100%;
        border: 1px solid #ccc;
    }

    .od-address>p {
        font-size: 18px;
        margin-left: 30px;
        margin-top: 10px;
        color: #555;
    }

    .od-address>p:nth-of-type(1)>span {
        font-size: 19px;
        font-weight: 600;
    }

    .od-process>p {
        margin-top: 10px;
    }

    .od-process>p:nth-of-type(1) {
        padding-bottom: 10px;
        border-bottom: 1px solid #ccc;
    }

    .od-process>p:nth-of-type(1) span {
        font-size: 18px;
        color: #555;
        margin-left: 18px;
        font-weight: 600;
    }

    .od-process>p:nth-of-type(1) span:nth-of-type(2) {
        margin-left: 80px;
        font-weight: 500;
    }

    .od-process>div {
        margin-top: 5px;
        font-size: 15px;
        color: #555;
    }

    .od-process>div p:nth-of-type(1) {
        margin-left: 20px;
    }

    .od-process>div p:nth-of-type(2) {
        margin-left: 120px;
    }

    .goods-content {
        width: 100%;
        height: 120px;
        margin-top: 10px;
        border: 1px solid #ccc;
    }

    .goods-content>div {
        height: 100%;
        float: left;
        margin-left: 10px;
    }

    .goods-content>div p {
        width: 420px;
        margin-top: 10px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .goods-content>div p:nth-of-type(1) {
        margin-top: 0px;
    }

    .goods-content>div:nth-of-type(1) {
        width: 120px;
    }

    .goods-content>div img {
        width: 120px;
        height: 100%;
    }

    .goods-content>div>button {
        padding: 0 5px;
        margin-left: 12px;
        margin-top: 10px;
    }

    .goods-content>div:nth-of-type(2) {
        width: 430px;
        border-right: 1px solid #ccc;
    }

    .goods-content>div:nth-of-type(3) {
        width: 95px;
        height: 100%;
    }

    .goods-content>div:nth-of-type(3) p {
        margin-left: 10px;
        color: #555;
    }

    .od-status>div {
        width: 320px;
        height: 210px;
        margin: 10px auto;
        margin-top: 20px;
        border-bottom: 1px solid #ccc;
    }

    .od-status>div p {
        margin-top: 15px;
    }

    .od-status>div span {
        margin-left: 10px;
        font-size: 18px;
        color: #555;
    }

    .od-status>div span:nth-of-type(1) {
        display: inline-block;
        width: 150px;
        text-align: right;
    }

    .od-status>div span:nth-of-type(2) {
        color: crimson;
    }

    .od-status>div p:last-of-type span:nth-of-type(2) {
        font-size: 22px;
    }

    .od-status button {
        width: 100px;
        height: 30px;
        margin-left: 175px;
        margin-top: 10px;
    }

    .od-status>button:nth-of-type(1) {
        margin-left: 175px;
    }

    .od-status>p {
        font-size: 20px;
        color: #555;
        margin-left: 150px;
    }
    .refund-box{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255,255,255,0.5);
        z-index: 100;
    }
    .refund-box>div{
        width: 480px;
        height: 220px;
        margin: 100px auto;
        background: #fff;
        border: 1px solid #aaa;
    }
    .refund-box>div>p{
        width: 450px;
        font-size: 18px;
        margin-top: 10px;
        margin-left: 10px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .refund-box>div>p:nth-of-type(2){
        margin-bottom: 10px;
    }
    .refund-box>div>span{
        font-size: 16px;
        vertical-align: top;
        margin-left: 10px;
    }
    .refund-box>div>textarea{
        margin-left: 10px;
        font-size: 16px;
        outline: none;
        line-height: 25px;
    }
    .refund-box>div>button{
        width: 100px;
        height: 30px;
        margin-top: 10px;
        margin-left: 5px;
    }
    .refund-box>div>button:nth-of-type(1){
        margin-left: 230px;
    }


    .pageBan {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 10;
        background: rgba(255, 255, 255, 0.5);
    }

    .pageBan>.orderPay{
        width: 300px;
        height: 150px;
        margin: 380px 730px;
        border: 1px solid #cccccc;
        background: #fff;
        
    }
    .pageBan>.orderPay>p{
        font-size: 18px;
        color: #333;
        text-indent: 30px;
        margin-top: 10px;
    }
    .pageBan>.orderPay>div{
        width: 100%;
        height: 35px;
        margin-top: 10px;
    }
    .pageBan>.orderPay>div:nth-of-type(1)>span{
        font-size: 16px;
        color: #444;
        margin-left: 30px;
    }
    .pageBan>.orderPay>div:nth-of-type(1)>input[type=password]{
        width: 150px;
        height: 26px;
        font-size: 18px;
    }
    .pageBan>.orderPay>div:nth-of-type(2)>button{
        padding: 5px 10px;
        border: none;
        outline: none;
        cursor: pointer;
        border-radius: 5px;
    }
    .pageBan>.orderPay>div:nth-of-type(2)>button:hover{
        background:crimson;
    }
    .pageBan>.orderPay>div:nth-of-type(2)>button:nth-of-type(1){
        margin-left: 145px;
    }
</style>