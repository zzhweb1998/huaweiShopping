<template>
    <div id="userInfo">
        <div class="userName">
            {{userAccount}}的基本信息
        </div>
        <div class="userDetailed">
            <p>
                <span>用户邮箱：{{}}</span>
            </p>
            <p>
                <span>用户余额：{{}}</span>
            </p>
            <p>
                <span>用户等级：{{}}</span>
            </p>
        </div>
        <div class="userOperate">

        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                userAccount:'',
                userInfo:''
            }
        },
        created(){
            this.userAccount = sessionStorage.getItem('account')
            console.log(this.userAccount);
            this.axios.post("/api/shop/userInfo",{
                account: this.userAccount
            }).then(res => {
                this.userInfo = res.data[0]
            })
            
        },
        methods:{

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
        width: 600px;
        height: 90%;
        border: 1px solid #333;
    }
    .userOperate{
        float: left;
        width: 400px;
        height: 90%;
        border: 1px solid #333;
    }
</style>