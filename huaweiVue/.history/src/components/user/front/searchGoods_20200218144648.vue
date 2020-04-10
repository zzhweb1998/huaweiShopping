<template>
    <div id="searchGoods">
        <div class="sg-title">
            <p>查询关键字：{{keyword}}</p>
        </div>
        <div class="sg-screenBox">
            <ul class="sg-category">
                <li>分类：</li>
                <li v-for="(ci,index) in categoryInfo" :key="index" :class="{'select':ci.no==categoryIndex}"
                    @click="selectIndex(1,ci.no)">{{ci.name}}</li>
            </ul>
            <ul class="sg-price">
                <li>价格区间：</li>
                <li v-for="(pi,index) in priceInfo" :key="index" :class="{'select':pi.no==priceIndex}"
                    @click="selectIndex(2,pi.no)">{{pi.name}}</li>
            </ul>
            <ul class="sg-sort">
                <li>排序：</li>
                <li v-for="(si,index) in sortInfo" :key="index" :class="{'select':si.no==sortIndex}"
                    @click="selectIndex(3,si.no)">{{si.name}}</li>
                <div class="risePrice" :class="{'riseSelect':sortIf==1}"></div>
                <div class="dropPrice" :class="{'dropSelect':sortIf==2}"></div>
            </ul>
        </div>
        <div class="sg-goodsBox">
            <div class="ng-box" v-for="(ps,index) in pageShow[pageCurrent]" :key="index"
                @click="selgoods(ps.goods_info_id)">
                <div class="ng-img">
                    <img :src=ps.browse_picture_name alt="">
                </div>
                <p class="ng-name">{{ps.goods_info_name}}</p>
                <p class="ng-title">{{ps.goods_info_title}}</p>
                <p class="ng-price">{{ps.goods_price}}</p>
            </div>
            <el-pagination background layout="prev, pager, next" :total="pageTotal" :page-size="pageSize"
                @current-change="currentChange" class="sg-page">
            </el-pagination>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                keyword: '',
                categoryInfo: [
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
                priceInfo: [
                    {
                        no: 1,
                        name: '0-999'
                    },
                    {
                        no: 2,
                        name: '1000-1999'
                    },
                    {
                        no: 3,
                        name: '2000-3999'
                    },
                    {
                        no: 4,
                        name: '>3999'
                    },
                ],
                sortInfo: [
                    {
                        no: 1,
                        name: '最新'
                    },
                    {
                        no: 2,
                        name: '销量'
                    },
                    {
                        no: 3,
                        name: '价格'
                    }
                ],
                categoryIndex: 0,
                priceIndex: 0,
                sortIndex: 1,
                sortIf: 0,
                pageTotal: 0, //总数据量
                pageCurrent: 0, //当前页数
                pageSize: 10,  //每页显示数量
                pageShow: [], //当前页显示数据
                goodsInfo: [],
                showData: ''
            }
        },
        created() {
            this.keyword = this.$route.query.keyword
            this.axios.post("/api/shop/searchDetailed").then(res => {
                res.data.filter(item => {
                    item.browse_picture_name = '../../../../static/image/' + item.browse_picture_name
                    this.goodsInfo.unshift(item)
                })
                this.showData = this.goodsInfo
                if (this.keyword == '') {
                    this.keyword = '全部'
                } else {
                    this.showData = this.goodsInfo.filter(item => {
                        if (item.goods_info_name.split(' ').join('').toUpperCase().includes(this.keyword.split(' ').join('').toUpperCase())) {
                            return item
                        }
                    })
                }
                this.pageTotal = this.showData.length

                for (let i = 0; i < this.pageTotal / this.pageSize; i++) {
                    this.pageShow[i] = this.showData.slice(this.pageSize * i, this.pageSize * (i + 1))
                }
            })
        },
        methods: {
            selectIndex(sel, index) {
                if (sel == 1) {
                    this.categoryIndex = index
                } else if (sel == 2) {
                    this.priceIndex = index
                } else if (sel == 3) {
                    if (index == 3) {
                        this.sortIndex = index
                        if (this.sortIf != 1) {
                            this.sortIf = 1
                        } else if (this.sortIf == 1) {
                            this.sortIf = 2
                        }
                    } else {
                        this.sortIf = 0
                        this.sortIndex = index
                    }
                }
            },
            currentChange(val) {
                this.pageCurrent = val - 1
            },
            selgoods(id) {
                this.$router.push({ path: '/user/goodsDetailed', query: { goods_id: id } })
            },
            pageUp() {
                this.pageTotal = this.showData.length
                for (let i = 0; i < this.pageTotal / this.pageSize; i++) {
                    this.pageShow[i] = this.showData.slice(this.pageSize * i, this.pageSize * (i + 1))
                }
            }
        }
    }
</script>

<style>
    #searchGoods {
        width: 100%;
        height: 1000px;
        margin-top: 10px;
    }

    .sg-title {
        width: 500px;
        height: 50px;
        margin-left: 30px;
        margin-top: 10px;
    }

    .sg-title>p {
        font-size: 22px;
        color: #555;
    }

    .sg-screenBox {
        width: 100%;
        height: 180px;
        border: 1px solid #eee;
    }

    .sg-screenBox>ul {
        width: 95%;
        height: 50px;
        margin: 10px auto;
        border-bottom: 1px solid #ccc;
    }

    .sg-screenBox>ul:last-of-type {
        border-bottom: none;
    }

    .sg-screenBox>ul li {
        float: left;
        width: 120px;
        font-size: 18px;
        line-height: 50px;
        list-style-type: none;
        color: #666;
    }

    .sg-screenBox>ul li:nth-of-type(n+2) {
        cursor: pointer;
        color: #333;
        text-align: center;
        margin-left: 30px;
    }

    .sg-screenBox>ul li:nth-of-type(n+2):hover {
        color: crimson;
    }

    .select {
        color: crimson !important;
    }

    .sg-screenBox>ul:last-of-type li:last-of-type {
        color: #333 !important;
    }

    .sg-screenBox>.sg-sort {
        position: relative;
    }

    .risePrice {
        position: absolute;
        top: 13px;
        left: 540px;
        content: '';
        display: block;
        border-width: 5px;
        border-style: solid;
        border-color: rgba(255, 255, 255, 0) rgba(255, 255, 255, 0) #333 rgba(255, 255, 255, 0);
    }

    .dropPrice {
        position: absolute;
        top: 30px;
        left: 540px;
        content: '';
        display: block;
        border-width: 5px;
        border-style: solid;
        border-color: #333 rgba(255, 255, 255, 0) rgba(255, 255, 255, 0) rgba(255, 255, 255, 0);
    }

    .riseSelect {
        border-color: rgba(255, 255, 255, 0) rgba(255, 255, 255, 0) crimson rgba(255, 255, 255, 0);
    }

    .dropSelect {
        border-color: crimson rgba(255, 255, 255, 0) rgba(255, 255, 255, 0) rgba(255, 255, 255, 0);
    }

    .sg-goodsBox {
        position: relative;
        width: 100%;
        height: 700px;
        margin-top: 20px;
        border: 1px solid #eee;
    }

    .sg-page {
        position: absolute;
        bottom: 20px;
        right: 50px;
    }

    .ng-box {
        float: left;
        width: 250px;
        height: 300px;
        text-align: center;
        cursor: pointer;
        margin-top: 10px;
        margin-left: 8px;
        border: 1px solid #f9f9f9;
        border-radius: 20px;
        background: #f9f9f9;
    }

    .ng-box:hover {
        background: #fefefe;
    }

    .ng-img {
        width: 170px;
        height: 170px;
        margin: 10px auto;
    }

    .ng-img>img {
        width: 100%;
        height: 100%;
    }

    .ng-name {
        font-size: 20px;
        color: #333;
    }

    .ng-title {
        width: 90%;
        margin: 10px auto;
        font-size: 16px;
        color: #888;
        text-align: center;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .ng-price {
        font-size: 16px;
        color: crimson;
    }
</style>