<template>
    <div id="adminAdd">
        <div class="ac-header">
            管理员添加
            <button @click="returnLast">返回</button>
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
</style>