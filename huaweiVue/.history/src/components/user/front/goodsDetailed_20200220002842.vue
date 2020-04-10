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
                        <div class="min-box">
                            <div v-for="(bp,index) in browsePicture" :key="index" 
                            :class="{'selBrowse':browseSel == index}">
                                <img :src=bp.browse_picture_name alt="">
                            </div>
                        </div>
                    </div>
                    <div class="roundLeft"><</div>
                    <div class="roundRight">></div>
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
                        :class="{'selColor':colorSel == index}">{{ci}}</div>
                    </div>
                </div>
                <div class="br-configure">
                    <p>选择配置：</p>
                    <div class="colorBox">
                        <div class="colorInfo" v-for="(ci,index) in colorInfo" :key="index"
                        :class="{'selColor':colorSel == index}">{{ci}}</div>
                    </div>
                </div>
                <p class="select-info">xxx</p>
                <div class="br-operate">

                </div>
            </div>
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
                browseSel:0
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
                this.colorIndex = this.goodsInfo.goods_color
                this.configureIndex = this.goodsInfo.goods_configure
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
        }
    }
</script>

<style>
    #goodsDetailed{
        width: 100%;
        height: auto;
        margin-top: 10px;
        border: 1px solid #333;
    }
    .gd-box{
        width: 100%;
        height: 700px;
        border: 1px solid #333
    }
    .gd-title{
        width: 100%;
        height: 30px;
        border: 1px solid #333
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
        height: 82%;
        border:1px solid #333
    }
    .gd-bRight{
        float: right;
        width: 64%;
        height: 82%;
        border: 1px solid #333;
    }
    .gd-browseBox{
        position: relative;
        width: 450px;
        height: 100%;
        margin: 0 auto;
        border: 1px solid #333;
    }
    .browse-show{
        width: 100%;
        height: 450px;
        border: 1px solid #333;
    }
    .browse-show>img{
        width: 100%;
        height: 100%;
    }
    .browse-min{
        width: 330px;
        height: 100px;
        margin: 0px auto;
        overflow: hidden;
        border: 1px solid #333;
    }
    .min-box{
        height: 100%;
    }
    .min-box>div{
        float: left;
        width: 60px;
        height: 60px;
        margin-left: 5px;
        margin-top: 20px;
        cursor: pointer;
        border: 1px solid #333;
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
        bottom: 42px;
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
    .br-color{
        width: 100%;
        height: 100px;
        margin-top: 10px;
        border: 1px solid #333;
    }
    .br-configure{
        width: 100%;
        height: 100px;
        margin-top: 10px;
        border: 1px solid #333;
    }
    .select-info{
        font-size: 18px;
        color: #aaa;
    }
    .br-operate{
        width: 100%;
        height: 100px;
        border: 1px solid #333;
    }
    .br-color>p{
        float: left;
        margin-top: 20px;
    }
    .colorBox{
        float: left;
        width: 700px;
        height: 100%;
        border: 1px solid #333;
    }
    .colorInfo{
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
    .selColor{
        border: 1px solid crimson !important;
    }
</style>