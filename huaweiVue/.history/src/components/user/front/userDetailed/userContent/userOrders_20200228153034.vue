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
                <div class="uo-box" v-for="(oi,index) in ordersShow" :key="index">
                    <div class="ordersHeader">
                        <p>{{oi.create_time}}&nbsp;&nbsp;&nbsp;&nbsp;订单号：{{oi.orders_no}}</p>
                        <p>
                            <span v-for="(sta,index1) in status" :key="index1"
                                v-if="sta.no == oi.orders_status">{{sta.name}}</span>
                        </p>
                    </div>
                    <div class="orders-goods">
                        <div class="og-Box" v-for="(og,index2) in ordersGoods" :key="index2"
                            v-if="og.orders_no == oi.orders_no">
                            <img :src=og.browse_picture_name alt="">
                            <div class="og-info">
                                <p>{{og.goods_info_title}}</p>
                                <p>{{og.goods_configure}} {{og.goods_color}}</p>
                            </div>
                            <div class="og-price">￥{{og.goods_price}}</div>
                            <div class="og-num">{{og.goods_num}}</div>
                        </div>
                    </div>
                    <div class="orders-price">￥{{oi.total_price}}</div>
                    <div class="orders-operate">
                        <div v-if="oi.orders_status == 0">立即付款</div>
                        <div v-if="oi.orders_status == 3">确认收货</div>
                        <div @click="detailedPage(oi.orders_no)">订单详情</div>
                    </div>
                    <div class="ordersPay" v-show="payIf == oi.orders_no">
                        <p>当前订单号：{{oi.orders_no}}</p>
                        <span>支付密码：</span>
                        <input type="password">
                        <div>
                            <button>确认支付</button>
                            <button>取消</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pageBan"></div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                userAccount: '',
                userInfo:'',
                selInfo: [
                    {
                        no: 1,
                        name: '全部有效订单'
                    },
                    {
                        no: 2,
                        name: '待付款'
                    },
                    {
                        no: 3,
                        name: '待发货'
                    },
                    {
                        no: 4,
                        name: '待收货'
                    },
                    {
                        no: 5,
                        name: '已完成'
                    },
                    {
                        no: 6,
                        name: '已取消'
                    },
                ],
                selIndex: 1,
                ordersInfo: [],
                ordersShow:[],
                ordersGoods: [],
                status: [
                    {
                        no: 0,
                        name: '待付款'
                    },
                    {
                        no: 1,
                        name: '待发货'
                    },
                    {
                        no: 2,
                        name: '已取消'
                    },
                    {
                        no: 3,
                        name: '待签收'
                    },
                    {
                        no: 4,
                        name: '已签收'
                    },
                ],
                payIf: 14
            }
        },
        created() {
            this.userAccount = sessionStorage.getItem('account')
            this.axios.post("/api/shop/allOD", {
                account: this.userAccount
            }).then(res => {
                this.ordersInfo = res.data
                this.ordersShow = this.ordersInfo
            })
            this.axios.post("/api/shop/allOG", {
                account: this.userAccount
            }).then(res => {
                res.data.filter(item => {
                    item.browse_picture_name = '../../../../static/image/' + item.browse_picture_name
                    this.ordersGoods.unshift(item)
                })
            })
            this.axios.post("/api/shop/userInfo",{
                account: this.userAccount
            }).then(res => {
                this.userInfo = res.data[0]
            })
        },
        methods: {
            selScreen(no) {
                if (this.selIndex != no) {
                    this.selIndex = no
                    this.ordersShow = []
                    if(this.selIndex == 1){
                        this.ordersShow = this.ordersInfo
                    }else if(this.selIndex == 2){
                        this.ordersInfo.filter(item => {
                            if(item.orders_status == 0){
                                this.ordersShow.push(item)
                            }
                        })
                    }else if(this.selIndex == 3){
                        this.ordersInfo.filter(item => {
                            if(item.orders_status == 1){
                                this.ordersShow.push(item)
                            }
                        })
                    }else if(this.selIndex == 4){
                        this.ordersInfo.filter(item => {
                            if(item.orders_status == 3){
                                this.ordersShow.push(item)
                            }
                        })
                    }else if(this.selIndex == 5){
                        this.ordersInfo.filter(item => {
                            if(item.orders_status == 4){
                                this.ordersShow.push(item)
                            }
                        })
                    }else if(this.selIndex == 6){
                        this.ordersInfo.filter(item => {
                            if(item.orders_status == 2){
                                this.ordersShow.push(item)
                            }
                        })
                    }
                }
            },
            detailedPage(no){
                this.$router.push({path:'/user/userDetailed/ordersDetailed',query:{ordersNo:no}})
            }
        }
    }
</script>

<style>
    #userOrders {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .uo-title {
        width: 100%;
        height: 50px;
        font-size: 24px;
        color: #333;
        line-height: 50px;
        text-indent: 20px;
        border-bottom: 1px solid #ccc;
    }

    .uo-select {
        width: 100%;
        height: 50px;
    }

    .uo-select>div {
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

    .uo-select>div:hover {
        color: #f9f9f9;
        background: #333;
    }

    .uo-select>.selKey {
        color: #f9f9f9;
        background: #333;
    }

    .uo-content {
        width: 100%;
        height: 430px;
        margin-top: 10px;
        overflow: hidden;
        overflow-y: scroll;
    }

    .uo-header {
        width: 100%;
        height: 40px;
        background: #f9f9f9;
    }

    .uo-header>div {
        float: left;
        height: 25px;
        text-align: center;
        margin-top: 8px;
        line-height: 25px;
        font-size: 16px;
        color: #777;
    }

    .uo-header>div:nth-of-type(n+2) {
        border-left: 1px solid #ccc;
    }

    .uo-header>div:nth-of-type(1) {
        width: 44%;
    }

    .uo-header>div:nth-of-type(2) {
        width: 14%;
    }

    .uo-header>div:nth-of-type(3) {
        width: 14%;
    }

    .uo-header>div:nth-of-type(4) {
        width: 14%;
    }

    .uo-header>div:nth-of-type(5) {
        width: 14%;
    }

    .uo-info {
        position: relative;
        width: 100%;
    }

    .uo-box {
        width: 100%;
        height: 160px;
    }

    .ordersHeader {
        width: 100%;
        height: 40px;
        font-size: 18px;
        color: #555;
        line-height: 40px;
        border-bottom: 1px solid #ccc;
    }

    .ordersHeader>p:nth-of-type(1) {
        float: left;
        margin-left: 10px;
    }

    .ordersHeader>p:nth-of-type(2) {
        float: right;
        margin-right: 20px;
    }

    .orders-goods {
        float: left;
        clear: both;
        width: 750px;
        height: 120px;
        overflow: hidden;
        overflow-y: scroll;
        margin-left: 0px;
    }

    .og-Box {
        width: 100%;
        height: 100%;
    }

    .og-Box>img {
        display: block;
        float: left;
        width: 120px;
        height: 120px;
    }

    .og-info {
        float: left;
        width: 330px;
        height: 100%;
    }

    .og-info>p {
        width: 100%;
        height: 45px;
        margin-top: 10px;
        color: #333;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }

    .og-price,
    .og-num {
        float: left;
        width: 140px;
        height: 100%;
        text-align: center;
        line-height: 50px;
        color: #777;
        text-indent: 5px;
    }

    .orders-price {
        float: left;
        width: 130px;
        height: 120px;
        text-align: center;
        line-height: 50px;
        color: #777;
    }

    .orders-operate {
        float: left;
        width: 135px;
        height: 120px;
    }
    .orders-operate>div{
        width: 100px;
        height: 30px;
        text-align: center;
        line-height: 30px;
        margin: 5px auto;
        cursor: pointer;
        border: 1px solid #333;
        background: #ff0036;
    }
    .ordersPay{
        position: absolute;
        top: 80px;
        right: 200px;
        width: 300px;
        height: 100px;
        border: 1px solid #333;
        background: #fff;
        z-index: 100;
    }
    .ordersPay>p{
        font-size: 18px;
        color: #333;
        margin-left: 10px;
    }
    .ordersPay>span{
        font-size: 16px;
        margin-left: 10px;
        margin-top: 5px;
    }
    .ordersPay>input[type=password]{
        margin-top: 5px;
        width: 120px;
        height: 20px;
        font-size: 18px;
    }
    .ordersPay>div>button{
        padding: 0 10px;
        font-size: 16px;
        margin-top: 10px;
    }
    .pageBan{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 10;
        background: rgba(255,255,255,0.5);
    }
</style>