<template>
    <div id="userInfo">
        <div class="userDetailed">
            <div class="userName">

            </div>
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
            this.userAccount = this.$route.query.account
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
    .userDetailed{
        float: left;
        width: 600px;
        height: 100%;
        border: 1px solid #333;
    }
    .userOperate{
        float: left;
        width: 400px;
        height: 100%;
        border: 1px solid #333;
    }
</style>