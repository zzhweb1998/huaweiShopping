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
            this.userAccount = sessionStorage.getItem('account')
            console.log(this.userAccount);
            this.axios.post("/api/shop/userInfo",{
                account: this.userAccount
            }).then(res => {
                console.log(res.data);
                
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