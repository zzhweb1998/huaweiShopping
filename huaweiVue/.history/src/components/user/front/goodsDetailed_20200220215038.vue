<template>
    <div id="goodsDetailed">
        <div class="gd-box">
            <div class="gd-title">
                <span>{{goodsInfo.goods_category}}系列</span>
                <span>></span>
                <span>{{goodsInfo.goods_info_name}}</span>
                <span>></span>
                <span>{{goodsInfo.goods_color}}</span>
                <span>{{goodsInfo.goods_configure}}</span>
            </div>
            <div class="gd-bLeft">
                <div class="gd-browseBox">
                    <div class="browse-show">
                        <img :src=browseShow alt="">
                    </div>
                    <div class="browse-min">
                        <div class="min-box" :style="{'left':'-'+(minIndex*65)+'px'}">
                            <div v-for="(bp,index) in browsePicture" :key="index" 
                            :class="{'selBrowse':browseSel == index}" @click="selBrowse(bp.browse_picture_name,index)">
                                <img :src=bp.browse_picture_name alt="">
                            </div>
                        </div>
                    </div>
                    <div class="roundLeft" @click="minLeft"><</div>
                    <div class="roundRight" @click="minRight">></div>
                </div>
            </div>
            <div class="gd-bRight">
                <p class="br-header">{{goodsInfo.goods_info_name}} {{goodsInfo.goods_color}} {{goodsInfo.goods_configure}}</p>
                <p class="br-title">{{goodsInfo.goods_info_title}}</p>
                <div class="br-goodsInfo">
                    <p>
                        <span>价&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;格：</span>
                        <span>￥{{goodsInfo.goods_price}}</span>
                    </p>
                    <p>运&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;费：全国免邮</p>
                    <p>发货地址：广东省 东莞市 寮步镇 东莞理工学院城市学院</p>
                    <p>商品编号：{{goodsInfo.goods_no}}</p>
                </div>
                <div class="br-color">
                    <p>选择颜色：</p>
                    <div class="colorBox">
                        <div class="colorInfo" v-for="(ci,index) in colorInfo" :key="index"
                        :class="{'selColor':colorSel == index}" @click="selColor(index)">{{ci}}</div>
                    </div>
                </div>
                <div class="br-configure">
                    <p>选择配置：</p>
                    <div class="configureBox">
                        <div class="configureInfo" v-for="(gi,index) in configureInfo" :key="index"
                        :class="{'selConfigure':configureSel == index}" @click="selConfigure(index)">{{gi}}</div>
                    </div>
                </div>
                <p class="select-info">已选择：{{goodsInfo.goods_color}} {{goodsInfo.goods_configure}}</p>
                <div class="br-operate">
                    <div class="operate-numBox">
                        <input type="number" min="1" max="999" step="1" @change="numIf" class="nb-input" 
                        v-model="goodsNum">
                        <div class="nb-add" @click="numAdd">+</div>
                        <div class="nb-reduce" @click="numReduce">-</div>
                    </div>
                    <button class="operate-shopcar">加入购物车</button>
                    <button class="operate-orders">立即下单</button>
                </div>
            </div>
        </div>
        <div class="prictureDetailed">

        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                goodsId:'',
                showNo:'',
                goodsDetailed:'',
                browseShow:'',
                browsePicture:[],
                colorInfo:[],
                configureInfo:[],
                colorSel: 0,
                configureSel: 0,
                goodsInfo:'',
                browseSel:0,
                goodsNum: 1,
                minIndex:0,
                detailedPicture:[]
            }
        },
        created(){
            this.goodsId = this.$route.query.goods_id
            this.axios.post("/api/shop/selectGD",{
                id: this.goodsId
            }).then(res => {
                this.goodsDetailed = res.data
                this.goodsDetailed.filter(item => {
                    this.colorInfo.push(item.goods_color)
                    this.configureInfo.push(item.goods_configure)
                })
                this.goodsInfo = this.goodsDetailed[0]
                this.showNo = this.goodsInfo.goods_no
                this.axios.post("/api/shop/selectBrowse",{
                    no:this.showNo
                }).then(res => {
                    this.browsePicture = res.data.filter(item => {
                        item.browse_picture_name = '../../../../static/image/' + item.browse_picture_name
                        return item
                    }) 
                    this.browseShow = this.browsePicture[0].browse_picture_name
                })
                this.colorInfo = Array.from(new Set(this.colorInfo))
                this.configureInfo = Array.from(new Set(this.configureInfo))   
            })
            this.axios.post("/api/shop/selectDetailed",{
                id: this.goodsId
            }).then(res => {
                res.data.filter(item => {
                    item.browse_picture_name = '../../../../static/image/' + item.browse_picture_name
                    this.detailedPicture.push(item)
                })
            })
        },
        methods:{
            numIf() {
                let regNum = /^[1-9]{1}\d*$/
                if (!regNum.test(this.goodsNum)) {
                    this.goodsNum = 1
                }else if(this.goodsNum > this.goodsInfo.stock_num){
                    this.goodsNum = 1
                }
            },
            numAdd(){
                if(this.goodsNum < this.goodsInfo.stock_num){
                    this.goodsNum ++ 
                }
            },
            numReduce(){
                if(this.goodsNum != 1){
                    this.goodsNum --
                }
            },
            selBrowse(url,index){
                this.browseSel = index
                this.browseShow = url
            },
            minLeft(){
                if(this.minIndex != 0){
                    this.minIndex -- 
                }
            },
            minRight(){
                if(this.browsePicture.length > 5){
                    if(this.minIndex < (this.browsePicture.length - 5)){
                        this.minIndex++
                    }
                }
            },
            selColor(index){
                this.colorSel = index
                this.selGoods()
            },
            selConfigure(index){
                this.configureSel = index
                this.selGoods()
            },
            selGoods(){
                this.goodsDetailed.filter(item => {
                    if(item.goods_color == this.colorInfo[this.colorSel] && item.goods_configure == this.configureInfo[this.configureSel]){
                        this.goodsInfo = item
                    }
                })
                this.showNo = this.goodsInfo.goods_no
                this.axios.post("/api/shop/selectBrowse",{
                    no:this.showNo
                }).then(res => {
                    this.browsePicture = res.data.filter(item => {
                        item.browse_picture_name = '../../../../static/image/' + item.browse_picture_name
                        return item
                    }) 
                    this.browseShow = this.browsePicture[0].browse_picture_name
                })
            }
        }
    }
</script>

<style>
    #goodsDetailed{
        width: 100%;
        height: auto;
        margin-top: 10px;
    }
    .gd-box{
        width: 100%;
        height: 620px;
        border-bottom: 1px solid #eee;
    }
    .gd-title{
        width: 100%;
        height: 30px;
    }
    .gd-title>span{
        color: #555;
        font-size: 14px;
        margin-left: 10px;
        line-height: 30px;
    }
    .gd-bLeft{
        float: left;
        width: 35%;
        height: 95%;
    }
    .gd-bRight{
        float: right;
        width: 64%;
        height: 95%;
    }
    .gd-browseBox{
        position: relative;
        width: 450px;
        height: 100%;
        margin: 0 auto;
    }
    .browse-show{
        width: 100%;
        height: 450px;
    }
    .browse-show>img{
        width: 100%;
        height: 100%;
    }
    .browse-min{
        position: relative;
        width: 330px;
        height: 100px;
        margin: 10px auto;
        overflow: hidden;
    }
    .min-box{
        position: absolute;
        top: 0;
        height: 100%;
    }
    .min-box>div{
        float: left;
        width: 60px;
        height: 60px;
        margin-left: 5px;
        margin-top: 20px;
        cursor: pointer;
        border: 1px solid #f5f5f5;
    }
    .min-box>div>img{
        width: 100%;
        height: 100%;
    }
    .selBrowse{
        border: 1px solid #ff0036 !important;
    }
    .roundLeft,.roundRight{
        position: absolute;
        bottom: 58px;
        width: 40px;
        height: 40px;
        text-align: center;
        font-size: 28px;
        line-height: 35px;
        color: #aaa;
        cursor: pointer;
        border: 1px solid #aaa;
        border-radius: 40px;
    }
    .roundLeft{
        left: 15px;
    }
    .roundRight{
        right: 15px;
    }
    .br-header{
        font-size: 26px;
        color: #555;
    }
    .br-title{
        font-size: 16px;
        color: #aaa;
    }
    .br-goodsInfo{
        width: 100%;
        height: 130px;
        font-size: 14px;
        color: #555;
        margin-top: 10px;
        background: #eee;
    }
    .br-goodsInfo>p{
        margin-top: 10px;
    }
    .br-goodsInfo>p:nth-of-type(1) span:nth-of-type(2){
        font-size: 22px;
        color: crimson;
    }
    .br-color,.br-configure{
        width: 100%;
        height: 110px;
        margin-top: 10px;
        overflow: hidden;
        border-bottom: 1px solid #eee;
    }
    .select-info{
        font-size: 14px;
        color: #aaa;
        margin-top: 10px;
    }
    .br-operate{
        width: 100%;
        height: 100px;
    }
    .br-color>p,.br-configure>p{
        float: left;
        margin-top: 20px;
    }
    .colorBox,.configureBox{
        float: left;
        width: 700px;
        height: 100%;
    }
    .colorInfo,.configureInfo{
        float: left;
        width: 150px;
        height: 40px;
        margin-left: 20px;
        margin-top: 10px;
        text-align: center;
        font-size: 16px;
        line-height: 35px;
        color: #333;
        cursor: pointer;
        border: 1px solid #555;
    }
    .configureInfo{
        font-size: 14px;
    }
    .selColor{
        border: 1px solid crimson !important;
    }
    .selConfigure{
        border: 1px solid crimson !important;
    }
    .operate-numBox{
        position: relative;
        float: left;
        width: 80px;
        height: 50px;
        margin-top: 20px;
    }
    .nb-input{
        width: 55px;
        height: 50px;
        font-size: 22px;
        text-align: center;
        color: #333;
        outline: none;
        border: 1px solid;
        border-color: #333 #fff #333 #333;
    }
    .nb-add,.nb-reduce{
        position: absolute;
        right: 0;
        width: 25px;
        height: 25px;
        text-align: center;
        font-size: 18px;
        line-height: 22px;
        cursor: pointer;
        border: 1px solid #333;
    }
    .nb-add{
        top: 0;
        border-color: #333  #333 #fff #333;
    }
    .nb-reduce{
        bottom: 0;
    }

    .operate-shopcar,.operate-orders{
        width: 160px;
        height: 50px;
        margin-top: 20px;
        margin-left: 20px;
        text-align: center;
        font-size: 18px;
        outline: none;
        cursor: pointer;
        color: #fff;
        border: none;
    }

    .operate-shopcar{
        background:orange;
    }
    .operate-orders{
        background:crimson;
    }
    .prictureDetailed{
        width: 100%;
        height: auto;
    }

    #goodsDetailed input::-webkit-outer-spin-button,
    #goodsDetailed input::-webkit-inner-spin-button {
        -webkit-appearance: none;
    }
    #goodsDetailed input[type="number"]{
        -moz-appearance: textfield;
    }

</style>