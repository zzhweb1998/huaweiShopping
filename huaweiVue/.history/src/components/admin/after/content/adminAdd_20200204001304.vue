<template>
    <div id="adminAdd">
        <div class="ac-header">
            管理员添加
            <button @click="returnLast">返回</button>
        </div>
        <div class="ac-content">
            <div>
                <span>账号：</span>
                <input type="text">
            </div>
            <div>
                <span>密码：</span>
                <input type="text">
            </div>
            <div>
                <span>邮箱：</span>
                <input type="text">
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{

            }
        },
        methods:{
            returnLast(){
                this.$router.go(-1)
            }
        }
    }
</script>

<style>
    #adminAdd{
        width: 100%;
        height: 100%;
    }
    .ac-header{
        width: 100%;
        height: 60px;
        background: #eee;
        font-size: 26px;
        font-weight: 600;
        line-height: 60px;
        text-indent: 100px;
        color: #555;
    }
    .ac-header>button{
        float: right;
        width: 80px;
        height: 40px;
        font-size: 18px;
        color: #333;
        margin-top: 10px;
        margin-right: 150px;
    }
    .ac-content{
        width: 800px;
        height: 500px;
        margin-top: 20px;
        margin-left: 100px;
        border: 1px solid #333;
    }
</style>