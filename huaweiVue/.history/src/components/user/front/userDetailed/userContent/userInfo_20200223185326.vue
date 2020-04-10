<template>
    <div id="userInfo">
        <div class="userName">
            {{userAccount}}的基本信息
        </div>
        <div class="userDetailed">
            <p>
                <span>用户邮箱：{{userInfo.user_email}}</span>
            </p>
            <p>
                <span>用户余额：{{userInfo.user_money}}</span>
                <button @click="selPage(1)">冲值</button>
            </p>
            <p>
                <span>用户等级：{{userInfo.user_Grade}}</span>
            </p>
            <button @click="selPage(2)">修改登陆密码</button>
            <button v-if="payIf == 1" @click="selPage(3)">修改支付密码</button>
            <button v-if="payIf == 0" @click="selPage(3)">设置支付密码</button>
        </div>
        <div class="userOperate">
            <div class="amPage" v-show="amShow == 1">
                1
            </div>
            <div class="pwPage" v-show="pwShow == 1">
                2
            </div>
            <div class="payPage" v-show="payShow == 1">
                3
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                userAccount:'',
                userInfo:'',
                pwShow:0,
                payShow:0,
                amShow:0,
                payIf:0
            }
        },
        created(){
            this.userAccount = sessionStorage.getItem('account')
            console.log(this.userAccount);
            this.axios.post("/api/shop/userInfo",{
                account: this.userAccount
            }).then(res => {
                this.userInfo = res.data[0]
                if(this.userInfo.user_pay != 0){
                    this.payIf = 1
                }
            })
            
        },
        methods:{
            selPage(index){
                if(index == 1){
                    this.amShow = 1
                    this.payShow = 0
                    this.pwShow = 0
                }else if(index == 2){
                    this.amShow = 0
                    this.payShow = 0
                    this.pwShow = 1
                }else if(index == 3){
                    this.amShow = 0
                    this.payShow = 1
                    this.pwShow = 0
                }
            }
        }
    }
</script>

<style>
    #userInfo{
        width: 100%;
        height: 100%;
        border: 1px solid #333;
    }
    .userName{
        width: 100%;
        height: 10%;
        line-height: 50px;
        font-size: 22px;
        text-indent: 30px;
        border: 1px solid #333;
        background: #eee;
    }
    .userDetailed{
        float: left;
        width: 400px;
        height: 90%;
        border: 1px solid #333;
    }
    .userDetailed>p{
        margin-top: 10px;
        margin-left: 30px;
    }
    .userDetailed>button{
        width: 120px;
        height: 40px;
        font-size: 16px;
        margin-top: 20px;
        margin-left: 10px;
    }
    .userDetailed>button:nth-of-type(1){
        margin-left: 30px;
    }
    .userDetailed>p>span{
        font-size: 18px;
        color: #333;
    }
    .userDetailed>p>button{
        width: 80px;
        height: 25px;
        font-size: 16px;
        margin-left: 10px;
    }
    .userOperate{
        float: left;
        width: 400px;
        height: 90%;
        border: 1px solid #333;
    }
    .userOperate>div{
        width: 100%;
        height: 100%;
        border: 1px solid #333;
    }
</style>