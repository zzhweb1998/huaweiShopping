<template>
    <div id="conNewgoods">
        <div class="conNewgoods-title">热销新品</div>
        <div class="ng-box" v-for="(gi,index) in goodsInfo" :key="index" v-if="index < 10">
            <div class="ng-img">
                <img :src=gi.browse_picture_name alt="">
            </div>
            <p class="ng-name">{{gi.goods_info_name}}</p>
            <p class="ng-title">{{gi.goods_info_title}}</p>
            <p class="ng-price">{{gi.goods_price}}</p>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                goodsInfo: []
            }
        },
        created() {
            this.axios.post("/api/shop/searchDetailed").then(res => {
                res.data.filter(item => {
                    item.browse_picture_name = '../../../../static/image/' + item.browse_picture_name
                    this.goodsInfo.unshift(item)
                })
            })
        }
    }
</script>

<style>
    #conNewgoods {
        width: 1300px;
        height: 700px;
        border: 1px solid #333;
        margin-top: 20px;
    }
    
    .conNewgoods-title{
        width: 300px;
        height: 50px;
        margin: 15px auto;
        border: 1px solid #333;
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
    .ng-img>img{
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