<template>
    <div id="afterHeader">
        <div class="ah-left">
            <p class="ah-title">华为手机商城后台管理系统</p>
        </div>
        <div class="ah-right">
            <span class="ah-name">管理员：{{adminAccount}}</span>
            <span class="ah-exit" @click="exit">退出</span>
        </div>
    </div>
</template>


<script>
    export default{
        data(){
            return{
                adminAccount:''
            }
        },
        created(){
            this.adminAccount = sessionStorage.getItem('admin')
        },
        methods:{
            exit(){
                let exitIf = confirm('是否退出当前管理员账号')
                if(exitIf == true){
                    sessionStorage.setItem('admin', null)
                }
            }
        }
    }
</script>


<style>
    #afterHeader{
        width: 100%;
        height: 10%;
        background: #444;
    }
    .ah-left{
        float: left;
        margin-left: 50px;
        margin-top: 15px;
    }
    .ah-left>p{
        font-size: 24px;
        color: #aaa;
    }
    .ah-right{
        float: right;
        margin-right: 150px;
        margin-top: 15px;
    }
    .ah-right>span{
        font-size: 18px;
        color: #aaa;
        margin-right: 20px;
    }
    .ah-right>span:nth-of-type(2){
        border-bottom: 1px solid #aaa;
        cursor: pointer;
        font-size: 17px;
    }
</style>