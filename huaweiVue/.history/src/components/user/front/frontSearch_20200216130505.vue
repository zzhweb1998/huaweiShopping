<template>
    <div id="frontSearch">
        <div class="fs-pictrueBox">
            <img src="../../../image/SXppnESYv4K11DBxDFc2.png" alt="">
        </div>
        <div class="fs-categoryBox">
            <div v-for="(cg,index) in category" :key="index" @mouseover="over(cg.no,cg.name)" @mouseleave="leave">
                <p>{{cg.name}}</p>
                <div class="cb-content" v-show="showIf == cg.no">
                    <div class="goodsBox" v-for="(gs,index2) in goodsShow" :key="index2" v-if="index2 < 4" @click="goodsDetailed(gs.goods_info_id)">
                        <img :src=gs.browse_picture_name alt="">
                        <p>{{gs.goods_info_name}}</p>
                        <p>￥{{gs.goods_price}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="searchBox">
            <div class="sb-border">
                <input type="text" placeholder="请输入搜索内容" v-model="keyword">
                <button @click="searchGood">搜索</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                category:[
                    {
                        no: 1,
                        name: 'Mate'
                    },
                    {
                        no: 2,
                        name: 'P'
                    },
                    {
                        no: 3,
                        name: 'nova'
                    },
                    {
                        no: 4,
                        name: '畅享'
                    },
                ],
                showIf: 0,
                goodsInfo:'',
                goodsShow:[],
                keyword:''
            }
        },
        created(){
            this.axios.post("/api/shop/searchDetailed").then(res => {
                this.goodsInfo = res.data
                console.log(this.goodsInfo);
                
            })
        },
        methods:{
            over(no,name){
                this.goodsShow = []
                this.goodsInfo.filter(item => {
                    if(item.goods_category == name){
                        this.goodsShow.unshift(item)
                    }
                })
                this.goodsShow.filter((item,index) => {
                    this.goodsShow[index].browse_picture_name = '../../../../static/image/'+item.browse_picture_name
                })
                this.showIf = no    
            },
            leave(){
                this.showIf = 0
                this.goodsShow = []
            },
            goodsDetailed(id){
                this.$router.push({path:'/user/goodsDetailed',query:{goods_id:id}})
                this.showIf = 0
                this.$router.go(0)
            },
            searchGood(){
                this.$router.push({path:'/user/searchGoods',query:{keyword:this.keyword}})
                this.$router.go(0)
            }
        }
    }
</script>

<style>
    #frontSearch{
        width: 100%;
        height: 100px;
        margin-top: 10px;
        z-index: 10;
    }
    #frontSearch>div{
        height: 100%;
        float: left;
    }
    .fs-pictrueBox{
        width: 320px;
    }
    .fs-pictrueBox>img{
        width: 250px;
        height: auto;
        margin-top: 25px;
        margin-left: 30px;
    }
    .fs-categoryBox{
        position: relative;
        width: 650px;
    }
    .fs-categoryBox>div{
        width: 100px;
        height: 50px;
        float: left;
        font-size: 22px;
        cursor: pointer;
        margin-top: 30px;
        border-right: 1px solid #ccc;
    }
    .fs-categoryBox>div>p{
        line-height: 50px;
        text-align: center;
    }
    .fs-categoryBox>div:hover>p{
        color: crimson;
    }
    .cb-content{
        position: absolute;
        top: 80px;
        left: -160px;
        width: 802px;
        height: 250px;
        border: 1px solid #ccc;
        background: #fff;
        z-index: 10px;
    }
    .goodsBox{
        float: left;
        width: 200px;
        height: 100%;
        text-align: center;
        border: 1px solid #ccc;
        z-index: 10;
    }
    .goodsBox>img{
        display: block;
        width: 150px;
        height: 150px;
        margin: 10px auto;
        border: 1px solid #333;
    }
    .goodsBox>p:nth-of-type(1){
        font-size: 20px;
        color: #555;
    }
    .goodsBox>p:nth-of-type(2){
        font-size: 18px;
        color: #ff0036;
    }
    .searchBox{
        width: 330px;
    }
    .sb-border{
        position: relative;
        width: 300px;
        height: 40px;
        border: 1px solid #999;
        margin-top: 35px;
        margin-left: 10px;
    }
    .sb-border>input[type=text]{
        width: 200px;
        height: 36px;
        margin-left: 10px;
        border: none;
        outline: none;
    }
    .sb-border>button{
        position: absolute;
        top: -1px;
        right: 0;
        width: 80px;
        height: 40px;
        padding: 0px;
        border: none;
        outline: none;
        cursor: pointer;
        margin-left: 3px;
        background: #ff0036;
    }
</style>

