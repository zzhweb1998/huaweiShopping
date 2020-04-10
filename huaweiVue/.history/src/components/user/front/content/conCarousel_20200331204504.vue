<template>
    <div id="conCarousel">
        <div class="cc-box" v-for="(ci,index) in carouselInfo" :key="index" @mouseover="over" 
        @mouseleave="leave" @click="selgoods(ci.goods_info_id)" v-show="showIf == index">
            <img :src=ci.carousel_name alt="">
        </div>
        <div class="select-box">
            <div class="cc-select" v-for="(ci,index) in carouselInfo" :key="index" :class="{'cc-show':showIf==index}"
            @mouseover="oversel(index)" @click="selgoods(ci.goods_info_id)">
                <div class="select-header"></div>
                <div class="select-content" v-show="showIf == index">
                    <div>
                        <img :src=ci.min_carousel alt="">
                    </div>
                    <div>{{ci.carousel_title}}</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                carouselInfo: '',
                showIf: 0,
                timer: null
            }
        },
        created() {
            this.axios.post("/api/shop/carouselInfo").then(res => {
                this.carouselInfo = res.data
                this.carouselInfo.filter((item, index) => {
                    this.carouselInfo[index].carousel_name = '../../../../../static/image/' + item.carousel_name
                    this.carouselInfo[index].min_carousel = '../../../../../static/image/' + item.min_carousel
                })
                console.log(this.carouselInfo);
            })
            //设置定时器
            this.timer = setInterval(() => {
                if (this.showIf != 3) {
                    this.showIf++
                } else {
                    this.showIf = 0
                }
            }, 3000)
        },
        methods: {
            //清除定时器
            over() {
                clearInterval(this.timer)
                this.timer = null
            },
            //开启定时器
            leave() {
                if(this.timer != null) return
                this.timer = setInterval(() => {
                    if (this.showIf != 3) {
                        this.showIf++
                    } else {
                        this.showIf = 0
                    }
                }, 3000)
            },
            //关闭定时器并选择选择轮播图
            oversel(index){
                clearInterval(this.timer)
                this.timer = null
                this.showIf = index
            },
            //切换当前轮播图商品详情页面
            selgoods(id){
                let account = sessionStorage.getItem('account')
                if (account == '' || account == null) {
                    this.$router.push('/userLogin')
                } else {
                    this.$router.push({path:'/user/goodsDetailed',query:{goods_id:id}})
                }
            }
        }
    }
</script>

<style>
    #conCarousel {
        position: relative;
        width: 1296px;
        height: 480px;
        border: 1px solid #eee;
        overflow: hidden;
    }

    .cc-box {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .cc-box>img {
        width: 100%;
        height: 100%;
        
    }

    .select-box {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: auto;

    }

    .cc-select {
        position: absolute;
        display: inline-block;
        top: -10px;
        width: 323px;
        height: auto;
        cursor: pointer;
        border: 1px solid #ccc;
        background: #fff;
    }

    .cc-select:nth-of-type(1) {
        left: 0;
    }

    .cc-select:nth-of-type(2) {
        left: 323px;
    }

    .cc-select:nth-of-type(3) {
        left: 646px;
    }

    .cc-select:nth-of-type(4) {
        left: 969px;
    }

    .cc-show {
        top: -70px;
    }

    .select-header {
        width: 100%;
        height: 10px;
    }

    .cc-select:nth-of-type(1) .select-header {
        background: Violet;
    }

    .cc-select:nth-of-type(2) .select-header {
        background: Pink;
    }

    .cc-select:nth-of-type(3) .select-header {
        background: SpringGreen;
    }

    .cc-select:nth-of-type(4) .select-header {
        background: CornflowerBlue;
    }

    .select-content {
        width: 100%;
        height: 60px;
    }

    .select-content>div {
        float: left;
    }

    .select-content>div:nth-of-type(1) {
        width: 50px;
        height: 50px;
        margin-top: 5px;
        margin-left: 10px;
    }

    .select-content>div img {
        width: 100%;
        height: 100%;
    }

    .select-content>div:nth-of-type(2) {
        line-height: 60px;
        font-size: 20px;
        color: #333;
        margin-left: 10px;
    }
</style>