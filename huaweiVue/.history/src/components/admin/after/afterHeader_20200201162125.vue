<template>
    <div id="afterHeader">
        <div class="ah-left">
            <p class="ah-title">华为手机商城后台管理系统</p>
        </div>
        <div class="ah-right">
            <span class="ah-name">{{adminAccount}}</span>
            <span class="ah-exit">退出</span>
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
        }
    }
</script>


<style>
    #afterHeader{
        width: 100%;
        height: 10%;
        border: 1px solid #333;
    }
    .ah-left{
        float: left;
        margin-left: 20px;
    }
    .ah-right{
        float: right;
        margin-right: 50px;
    }
</style>