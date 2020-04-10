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
                <p>余额冲值</p>
                <p>
                    <span>金额：</span>
                    <input type="number" min="0" step="0.01" v-model="addMoney">
                </p>
                <button>冲值</button>
            </div>
            <div class="pwPage" v-show="pwShow == 1">
                <p>修改登陆密码</p>
                <p>
                    <span>请输入旧密码：</span>
                    <input type="password" min="0" step="0.01" v-model="newPW">
                </p>
                <p>
                    <span>请输入新密码：</span>
                    <input type="password" min="0" step="0.01" v-model="oldPW">
                </p>
                <p>
                    <span>再确认新密码：</span>
                    <input type="password" min="0" step="0.01" v-model="repeatPW">
                </p>
                <button>修改</button>
            </div>
            <div class="payPage" v-show="payShow == 1">
                <p>修改支付密码</p>
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
                payIf:0,
                addMoney: 0,
                newPW: '',
                oldPW:'',
                repeatPW:''
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
        border: 1px solid #f9f9f9;
    }
    .userOperate>div>p:nth-of-type(1){
        width: 100%;
        height: 40px;
        line-height: 40px;
        font-size: 18px;
        background: #f9f9f9;
    }
    .amPage span{
        font-size: 16px;
        color: #333;
    }
    .amPage input[type=number]{
        width: 120px;
        height: 30px;
    }
    .amPage>button{
        width: 80px;
        height: 30px;
        margin-top: 10px;
        margin-left: 90px;
    }
    .pwPage>p:nth-of-type(n+2){
        margin-top: 10px;
        font-size: 16px;
    }
    .pwPage input[type=password]{
        width: 150px;
        height: 30px;
        font-size: 20px;
    }
</style>