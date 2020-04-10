<template>
    <div id="goodsDetailed">
        <div class="gd-box">
            <div class="gd-bLeft">
                <div class="gd-browseBox">
                    <div class="browse-show">
                        <img :src=browseShow alt="">
                    </div>
                    <div class="browse-min">
                        <div class="min-box">
                            <div v-for="(bp,index) in browsePicture" :key="index" 
                            :class="{'selBrowse':index == index}">
                                <img :src=bp.browse_picture_name alt="">
                            </div>
                        </div>
                    </div>
                    <div class="roundLeft"><</div>
                    <div class="roundRight">></div>
                </div>
            </div>
            <div class="gd-bRight">

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
                colorIndex: '',
                configureIndex:'',
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
        height: 600px;
        border: 1px solid #333
    }
    .gd-bLeft{
        float: left;
        width: 35%;
        height: 100%;
        border:1px solid #333
    }
    .gd-bRight{
        float: right;
        width: 64%;
        height: 100%;
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
    .min-box>.selBrowse{
        border: 1px solid #ff0036;
    }
    .roundLeft,.roundRight{
        position: absolute;
        bottom: 70px;
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
</style>