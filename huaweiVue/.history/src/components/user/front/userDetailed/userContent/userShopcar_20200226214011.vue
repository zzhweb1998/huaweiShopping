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
            <div class="goods-box">
                <div class="gb-sel"></div>
                <div class="gb-img"></div>
                <div class="gb-info"></div>
                <div class="gb-price"></div>
                <div class="gb-num">
                    <input type="text">
                    <div class="num-cut">-</div>
                    <div class="num-add">+</div>
                </div>
                <div class="gb-total"></div>
                <div class="gb-operate"></div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                allIf: 0
            }
        },
        created(){

        },
        methods:{
            allSel(){
                if(this.allIf == 0){
                    this.allIf = 1
                }else{
                    this.allIf = 0
                }
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
        background: #f5f5f5;
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
    .allSel{
        display: block !important;
    }
    .us-sel>span{
        font-size: 16px;
        line-height: 40px;
        margin-left: 5px;
    }
    .us-content{
        width: 100%;
        height: 495px;
        background: #f9f9f9;
        margin-top: 10px;
        overflow: hidden;
        overflow-y: scroll;
    }
    .goods-box{
        width: 100%;
        height: 120px;
        border: 1px solid #333;
    }
    .goods-box>div{
        float: left;
        border: 1px solid #333;
    }
    .gb-sel{
        width: 20px;
        height: 20px;
        cursor: pointer;
        margin-left: 48px;
        margin-top: 40px;
    }
    .gb-img{
        width: 120px;
        height: 120px;
        border: 1px solid #333;
    }
    .gb-info{
        width: 380px;
        height: 100%;
        border: 1px solid #333;
    }
    .gb-price,.gb-num,.gb-total,.gb-operate{
        width: 98px;
        height:40px;
        margin-top: 10px;
        margin-left: 15px;
        border: 1px solid #333;
        text-align: center;
        line-height: 40px;
        font-size: 16px;
    }
    .gb-num{
        position: relative;
    }
    .gb-num>input[type=text]{
        width: 40px;
        height: 25px;  
        outline: none; 
        text-align: center;
        border: 1px solid;
        border-color: #aaa #fff #aaa #fff;
    }
    .gb-num>div{
        position: absolute;
        top: 10px;
        width: 25px;
        height: 25px;
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
</style>