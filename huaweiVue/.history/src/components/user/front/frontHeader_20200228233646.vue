<template>
    <div id="frontHeader">
        <div class="fh-left">
            <span @click="firstPage">华为商城首页</span>
        </div>
        <div class="fh-right">
            <span @click="login" v-show="loginIf==0">用户登陆</span>
            <span @click="user" v-show="loginIf==1">{{userAccount}}</span>
            <span @click="shopcar">购物车</span>
            <span @click="orders">订单</span>
            <div class="ui-Box">
                <div></div>
                <div class="ui-content">
                    <p>账号：</p>
                    <p>余额：</p>
                    <p>会员等级：</p>
                    <button>退出</button>
                </div>
            </div>
        </div>
        <div class="fh-bg"></div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                userAccount:'',
                loginIf: 0
            }
        },
        created(){
            this.userAccount = sessionStorage.getItem('account')
            if(this.userAccount == '' || this.userAccount == null){
                this.loginIf = 0
            }else{
                this.loginIf = 1
            }
        },
        methods:{
            login(){
                this.$router.push('/userLogin')
            },
            user(){
                this.$router.push('/user/userDetailed')
            },
            shopcar(){
                if(this.loginIf == 1){
                    this.$router.push('/user/userDetailed/userShopcar')
                }else{
                    this.$router.push('/userLogin')
                }
            },
            orders(){
                if(this.loginIf == 1){
                    this.$router.push('/user/userDetailed/userOrders')
                }else{
                    this.$router.push('/userLogin')
                }
            },
            firstPage(){
                this.$router.push('/user')
            }
        }
    }
</script>

<style>
    #frontHeader{
        width: 100%;
        height: 40px;
        background: #333;
    }
    .fh-left{
        float: left;
        margin-top: 8px;
    }
    .fh-right{
        position: relative;
        float: right;
        margin-top: 8px;
    }
    #frontHeader span{
        color: #aaa;
        margin-right: 10px;
        cursor: pointer;
    }
    #frontHeader span:nth-of-type(n+3)::before{
        content: '|';
        margin-right: 10px;
        font-size: 14px;
        color: #999;
    }
    .fh-bg{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 40px;
        background: #333;
        z-index: -1;
    }
    .ui-Box{
        position: absolute;
        top: 20px;
        right: 30px;
        width: 300px;
        height: 120px;
        z-index: 100;
    }
    .ui-Box>div:nth-of-type(1){
        width: 0px;
        margin-left: 100px;
        border-width: 8px;
        border-style: solid;
        border-color: #333 #333 #f9f9f9 #333; 
    }
    .ui-content{
        width: 100%;
        height: 100px;
        background: #f9f9f9;
    }
</style>