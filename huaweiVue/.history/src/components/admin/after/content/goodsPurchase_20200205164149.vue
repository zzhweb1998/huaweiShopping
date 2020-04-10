<template>
    <div id="goodsPurchase">
        <div class="ac-header">
            商品进货
            <button @click="returnLast">返回</button>
        </div>
        <div class="purchase-content">
            <div class="purchase-info">
                <p>商品编号：{{goodsInfo[0].goods_no}}</p>
                <p>商品名称：{{goodsInfo[0].goods_info_name}}</p>
                <p>商品颜色：{{goodsInfo[0].goods_color}}</p>
                <p>商品配置：{{goodsInfo[0].goods_configure}}</p>
                <p>商品库存：{{goodsInfo[0].stock_num}}</p>
                <p>进货总数：{{goodsInfo[0].purchase_sum}}</p>
                <p>进货总额：{{goodsInfo[0].purchase_total}}</p>
            </div>
            <div class="purchase-operate">
                <div>
                    进货数量：
                    <input type="number" min="0" step="1" @change="numIf" v-model="purchaseNum">
                </div>
                <div>
                    进货金额：
                    <input type="number" min="0" step="0.01" @change="priceIf" v-model="purchasePrice">
                </div>
                <button>进货</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                goodsNo:'',
                goodsInfo:'',
                purchaseNum:'',
                purchasePrice:''
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
            numIf(){
                let regNum = /\d/
                if(!regNum.test(this.purchaseNum)){
                    this.purchaseNum = 0
                }
            },
            priceIf(){
                let priceReg = /(^[1-9]\d*(\.\d{1,2})?$)|(^0(\.\d{1,2})?$)/
                if (!priceReg.test(this.goodsPrice)) {
                    this.goodsPrice = 0
                }
            }
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
        width: 620px;
        height: 300px;
        margin-top: 30px;
        margin-left: 100px;
        border: 1px solid #ccc;
    }
    .purchase-info{
        float: left;
        width: 300px;
        height: 100%;
        border-right: 1px solid #ccc;
    }
    .purchase-operate{
        float: left;
        width: 300px;
        height: 100%;
        margin-left: 10px;
    }
    .purchase-info>p{
        font-size: 18px;
        margin-top: 10px;
        margin-left: 10px;
    }
    .purchase-operate>div{
        width: 100%;
        height: 40px;
        margin-top: 10px;
        font-size: 18px;
    }
    .purchase-operate input[type=number]{
        width: 120px;
        height: 30px;
        vertical-align: middle;
    }
    .purchase-operate button{
        width: 80px;
        height: 30px;
        font-size: 16px;
        margin-left: 135px;
        margin-top: 10px;
    }
</style>