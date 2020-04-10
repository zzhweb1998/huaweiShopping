<template>
    <div id="goodsPurchase">
        <div class="ac-header">
            商品进货
            <button @click="returnLast">返回</button>
        </div>
        <div class="purchase-content">
            <div class="purchase-info">
                <p>商品编号：{{}}</p>
                <p>商品名称：{{}}</p>
                <p>商品颜色：{{}}</p>
                <p>商品配置：{{}}</p>
                <p>商品库存：{{}}</p>
                <p>进货总数：{{}}</p>
                <p>进货总额：{{}}</p>
            </div>
            <div class="purchase-operate">

            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                goodsNo:'',
                goodsInfo:''
            }
        },
        created(){
            this.goodsNo = this.$route.query.goodsno
            this.axios.post("/api/shop/selectGN",{
                no: this.goodsNo
            }).then(res => {
                this.goodsInfo = res.data
            })
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
        border: 1px solid #ccc;
    }
    .purchase-info{
        float: left;
        width: 350px;
        height: 100%;
        border: 1px solid #333;
    }
    .purchase-operate{
        float: left;
        width: 350px;
        height: 100%;
        border: 1px solid #333;
    }
</style>