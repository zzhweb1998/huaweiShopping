<template>
    <div id="goodsDetailed">
        <div class="gd-box">
            <div class="gd-bLeft">
                <div class="gd-browseBox">
                    <div class="browse-show">
                        <img src="" alt="">
                    </div>
                    <div class="browse-min">
                        <div class="min-box">
                            <div>
                                <img src="" alt="">
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
                browsePicture:'',
            }
        },
        created(){
            this.goodsId = this.$route.query.goods_id
            console.log(this.goodsId);
            this.axios.post("/api/shop/selectGD",{
                id: this.goodsId
            }).then(res => {
                this.goodsDetailed = res.data
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
        width: 60px;
        height: 60px;
        margin-left: 5px;
        margin-top: 20px;
        border: 1px solid #333;
    }
    .min-box>div>img{
        width: 100%;
        height: 100%;
    }
    .roundLeft,.roundRight{
        position: absolute;
        bottom: 65px;
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