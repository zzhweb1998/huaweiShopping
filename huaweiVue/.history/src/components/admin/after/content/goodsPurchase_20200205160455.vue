<template>
    <div id="goodsPurchase">
        <div class="ac-header">
            商品进货
            <button @click="returnLast">返回</button>
        </div>
        <div class="purchase-content">

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
            returnLast() {
                this.$router.go(-1)
            },
        }
    }
</script>

<style>
    #goodsPurchase{
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
    .ac-header>button {
        float: right;
        width: 80px;
        height: 40px;
        font-size: 18px;
        color: #333;
        margin-top: 10px;
        margin-right: 150px;
    }
    .purchase-content{
        width: 1100px;
        height: 400px;
        margin: 30px auto;
        border: 1px solid #333;
    }
</style>