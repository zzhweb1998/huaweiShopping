<template>
    <div id="manageCarousel">
        <div class="ac-header">
            轮播图管理
        </div>
        <div class="mc-box">
            <div class="mc-operate">
                <iframe id="hide_iframe" name="hide_iframe" style="display:none;"></iframe>
                <form action="/api/shop/carouselUpload" method="post" enctype="multipart/form-data" target="hide_iframe">
                    <input type="text" name="order" v-model="carouselOrder" v-show="false">
                    <input type="submit" value="提交" ref="upload" v-show="false">
                    <div>
                        <span>轮播顺序：</span>
                        <el-select v-model="carouselOrder">
                            <el-option v-for="item in order" :key="item.value" :label="item.label" :value="item.value">
                            </el-option>
                        </el-select>
                    </div>
                    <div>
                        <span>轮播图片：</span>
                        <input type="file" name="pic">
                    </div>
                    <div>
                        <span>轮播小图：</span>
                        <input type="file" name="min">
                    </div>
                    <div>
                        <span>轮播标题：</span>
                        <input type="text" name="title" v-model="carouselTitle">
                    </div>
                    <div>
                        <span>商 品 ID ：</span>
                        <input type="text" name="id" v-model="carouselGoods">
                    </div>
                </form>
                <button @click="dafine">确 定</button>
            </div>
            <div class="mc-content">
                <div v-for="(ci,index) in carouselInfo" :key="index">
                    <div>
                        <span>商品ID：{{ci.goods}}</span>
                        <span>轮播图标题：{{ci.title}}</span>
                    </div>
                    <img :src=ci.name alt="">
                    <img :src=ci.min alt="">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                carouselOrder: 1,
                carouselPicture: '',
                carouselMin: '',
                carouselTitle: '',
                carouselGoods: '',
                order: [
                    {
                        value: 1,
                        label: 1
                    },
                    {
                        value: 2,
                        label: 2
                    },
                    {
                        value: 3,
                        label: 3
                    },
                    {
                        value: 4,
                        label: 4
                    },
                ],
                carouselInfo: [
                    {
                        id: 1,
                        name: '',
                        min: '',
                        goods: '',
                        title:''
                    },
                    {
                        id: 2,
                        name: '',
                        min: '',
                        goods: '',
                        title:''
                    },
                    {
                        id: 3,
                        name: '',
                        min: '',
                        goods: '',
                        title:''
                    },
                    {
                        id: 4,
                        name: '',
                        min: '',
                        goods: '',
                        title:''
                    },
                ]
            }
        },
        created() {
            this.axios.post("/api/shop/carouselInfo").then(res => {
                res.data.filter(item => {
                    this.carouselInfo.filter((item2, index) => {
                        if (item2.id == item.carousel_id) {
                            this.carouselInfo[index].name = '../../../../../static/image/' + item.carousel_name
                            this.carouselInfo[index].min = '../../../../../static/image/' + item.min_carousel
                            this.carouselInfo[index].goods = item.goods_info_id
                            this.carouselInfo[index].title = item.carousel_title
                        }
                    })
                })
            })
        },
        methods: {
            dafine() {
                this.axios.post("/api/shop/selectDetailed", {
                    id: this.carouselGoods
                }).then(res => {
                    if (res.data != '') {
                        this.$refs.upload.click()
                        let _this = this
                        setTimeout(function () {
                            alert('上传信息结束')
                            _this.$router.go(0)
                        }, 1000)
                    }else{
                        alert('请输入正确的商品ID')
                    }
                })
            },
        }
    }
</script>

<style>
    #manageCarousel {
        width: 100%;
        height: 100%;
    }

    .ac-header {
        width: 100%;
        height: 60px;
        background: #eee;
        font-size: 26px;
        font-weight: 600;
        line-height: 60px;
        text-indent: 100px;
        color: #555;
    }

    .mc-box {
        width: 100%;
        height: 585px;
        border: 1px solid #333;
    }

    .mc-operate {
        width: 32%;
        height: 100%;
        float: left;
        border-right: 1px solid #aaa;
    }

    .mc-operate>form>div {
        width: 100%;
        height: 60px;
        margin-top: 10px;
        line-height: 60px;
    }

    .mc-operate>form>div span {
        font-size: 20px;
        margin-left: 20px;
    }

    .mc-operate>form>div:nth-of-type(4) input[type=text] {
        width: 230px;
        height: 40px;
    }
    .mc-operate>form>div:nth-of-type(1) input[type=text],
    .mc-operate>form>div:nth-of-type(5) input[type=text]{
        width: 80px;
        height: 40px;
    }

    .mc-operate>button {
        width: 100px;
        height: 40px;
        font-size: 20px;
        margin-left: 200px;
        margin-top: 10px;
    }

    .el-select-dropdown {
        width: 100px !important;
        height: auto !important;
    }

    .mc-operate>div .el-input__inner {
        width: 80px;
        height: 40px;
    }

    .mc-content {
        width: 67%;
        height: 100%;
        float: left;
        margin-left: 10px;
        overflow: hidden;
        overflow-y: scroll;
    }

    .mc-content>div {
        width: 100%;
        height: 30%;
        border: 1px solid #333;
        margin-top: 10px;
    }

    .mc-content>div>img {
        display: inline-block;
        margin-top: 10px;
        margin-left: 50px;
    }

    .mc-content>div>img:nth-of-type(1) {
        width: 400px;
        height: 120px;
    }

    .mc-content>div>img:nth-of-type(2) {
        width: 50px;
        height: 50px;
    }

    .mc-content>div>div {
        width: 100%;
        height: 30px;
    }
    .mc-content>div>div>span{
        font-size: 18px;
        line-height: 30px;
        margin-left: 20px;
    }
</style>