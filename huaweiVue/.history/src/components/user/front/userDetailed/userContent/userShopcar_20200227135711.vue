<template>
    <div id="userShopcar">
        <div class="us-header">
            <div class="us-sel">
                <div class="selBox" @click="allSel">
                    <div :class="{'allSel':allIf == 1}">√</div>
                </div>
                <span>全选</span>
            </div>
            <div>商品</div>
            <div>单价</div>
            <div>数量</div>
            <div>小计</div>
            <div>操作</div>
        </div>
        <div class="us-content">
            <div class="goods-box" v-for="(gi,index) in goodsInfo" :key="index">
                <div class="gb-sel">
                    <div :class="{'allSel':gi.shopcar_status == 1}">√</div>
                </div>
                <div class="gb-img">
                    <img :src=gi.browse_picture_name>
                </div>
                <div class="gb-info">
                    <p>{{gi.goods_info_title}}</p>
                    <p>{{gi.goods_color}} {{gi.goods_configure}}</p>
                </div>
                <div class="gb-price">￥{{gi.goods_price}}</div>
                <div class="gb-num">
                    <input type="number" min="1" step="1" @change="numIf(index)" v-model="goodsInfo[index].goods_num">
                    <div class="num-cut" @click="numReduce(index)">-</div>
                    <div class="num-add" @click="numAdd(index)">+</div>
                </div>
                <div class="gb-total">￥{{(gi.goods_price * gi.goods_num).toFixed(2)}}</div>
                <div class="gb-operate">
                    <span>删除</span>
                </div>
            </div>
        </div>
        <div class="us-operate">
            <button>结 算</button>
            <p>
                <span>总计：</span>
                <span>￥{{totalPrice}}</span>
            </p>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                userAccount:'',
                allIf: 0,
                goodsInfo: [],
                totalPrice: 0
            }
        },
        created(){
            this.userAccount = sessionStorage.getItem('account')
            this.axios.post("/api/shop/shopcarInfo",{
                account: this.userAccount
            }).then(res => {
                res.data.filter(item => {
                    item.browse_picture_name = '../../../../static/image/' + item.browse_picture_name
                    if(item.shopcar_status == 1){
                        this.totalPrice = (this.totalPrice + (item.goods_price * item.goods_num)).toFixed(2)
                    }
                    this.goodsInfo.unshift(item)
                })
            })

        },
        methods:{
            allSel(){
                if(this.allIf == 0){
                    this.allIf = 1
                }else{
                    this.allIf = 0
                }
            },
            numIf(index) {
                let regNum = /^[1-9]{1}\d*$/
                if (!regNum.test(this.goodsInfo[index].goods_num)) {
                    this.goodsInfo[index].goods_num = 1
                }else if(this.goodsInfo[index].goods_num > this.goodsInfo[index].stock_num){
                    this.goodsInfo[index].goods_num = 1
                }
            },
            numAdd(index){
                if(this.goodsInfo[index].goods_num < this.goodsInfo[index].stock_num){
                    this.goodsInfo[index].goods_num ++ 
                    this.countPrice()
                }
            },
            numReduce(index){
                if(this.goodsInfo[index].goods_num != 1){
                    this.goodsInfo[index].goods_num --
                    this.countPrice()
                }
            },
            countPrice(){
                this.goodsInfo.filter(item => {
                    if(item.shopcar_status == 1){
                        this.totalPrice = (this.totalPrice + (item.goods_price * item.goods_num)).toFixed(2)
                    }
                })
            }
        }
    }
</script>

<style>
    #userShopcar{
        width: 100%;
        height: 100%;
    }
    .us-header{
        width: 100%;
        height: 40px;
        background: #f9f9f9;
    }
    .us-header>div{
        float: left;
        margin-left: 50px;
        font-size: 16px;
        line-height: 40px;
    }
    .us-header>div:nth-of-type(2){
        margin-left: 80px;
    }
    .us-header>div:nth-of-type(3){
        margin-left: 400px;
    }
    .us-header>div:nth-of-type(n+4){
        margin-left: 80px;
    }
    .us-sel>div{
        float: left;
        width: 20px;
        height: 20px;
        margin-top: 10px;
        cursor: pointer;
        border: 1px solid #333;
    }
    .selBox>div{
        display: none;
        width: 100%;
        height: 100%;
        text-align: center;
        line-height: 20px;
    }
    .us-sel>span{
        font-size: 16px;
        line-height: 40px;
        margin-left: 5px;
    }
    .us-content{
        width: 100%;
        height: 450px;
        background: #f9f9f9;
        margin-top: 10px;
        overflow: hidden;
        overflow-y: scroll;
    }
    .goods-box{
        width: 100%;
        height: 120px;
        border: 1px solid #eee;
    }
    .goods-box>div{
        float: left;
        font-size: 14px;
        color: #333;
    }
    .gb-sel{
        width: 20px;
        height: 20px;
        cursor: pointer;
        margin-left: 48px;
        margin-top: 40px;
        border: 1px solid #333;
    }
    .gb-sel>div{
        display: none;
        width: 100%;
        height: 100%;
        text-align: center;
        line-height: 20px;
    }
    .gb-img{
        width: 120px;
        height: 120px;
    }
    .gb-img>img{
        width: 95%;
        height: 95%;
        margin-left: 3px;
        margin-top: 3px;
    }
    .gb-info{
        width: 380px;
        height: 100%;
    }
    .gb-info>p{
        margin-top: 10px;
    }
    .gb-info>p:nth-of-type(2){
        color: #555;
    }
    .gb-price,.gb-num,.gb-total,.gb-operate{
        width: 98px;
        height:40px;
        margin-top: 10px;
        margin-left: 15px;
        text-align: center;
        line-height: 40px;
        font-size: 16px;
    }
    .gb-operate>span{
        color: #555;
        cursor: pointer;
    }
    .gb-num{
        position: relative;
        line-height: 38px;
    }
    .gb-num>input[type=number]{
        width: 40px;
        height: 26px;  
        outline: none; 
        text-align: center;
        border: 1px solid;
        border-color: #aaa #fff #aaa #fff;
    }
    .gb-num>div{
        position: absolute;
        top: 7px;
        width: 25px;
        height: 26px;
        font-size: 20px;
        line-height: 23px;
        text-align: center;
        color: #666;
        cursor: pointer;
        border: 1px solid #aaa;
    }
    .num-cut{
        left: 4px;
    }
    .num-add{
        left: 67px;
    }

    .us-operate{
        width: 100%;
        height: 40px;
    }

    .us-operate>button{
        float: right;
        width: 120px;
        height: 40px;
        color: #fff;
        outline: none;
        border: none;
        font-size: 20px;
        cursor: pointer;
        background: #ff0036;
    }
    .us-operate>p{
        float: right;
        margin-top: 5px;
        margin-right: 20px;
    }
    .us-operate>p>span:nth-of-type(1){
        font-size: 16px;
        color: #333;
    }
    .us-operate>p>span:nth-of-type(2){
        font-size: 20px;
        color: #ff0036;
    }

    .allSel{
        display: block !important;
    }
    #userShopcar input::-webkit-outer-spin-button,
    #userShopcar input::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }
    #userShopcar input[type="number"]{
        -moz-appearance: textfield;
    }
</style>