<template>
    <div id="searchGoods">
        <div class="sg-screenBox">
            <ul class="sg-category">
                <li>分类：</li>
                <li v-for="(ci,index) in categoryInfo" :key="index" :class="{'select':ci.no==categoryIndex}">{{ci.name}}</li>
            </ul>
            <ul class="sg-price">
                <li>价格区间：</li>
                <li v-for="(pi,index) in priceInfo" :key="index">{{pi.name}}</li>
            </ul>
            <ul class="sg-sort">
                <li>排序：</li>
                <li v-for="(si,index) in sortInfo" :key="index">{{si.name}}</li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                categoryInfo:[
                    {
                        no:1,
                        name:'Mate'
                    },
                    {
                        no:2,
                        name:'P'
                    },
                    {
                        no:3,
                        name:'nova'
                    },
                    {
                        no:4,
                        name:'畅享'
                    },
                ],
                priceInfo:[
                    {
                        no:1,
                        name:'0-999'
                    },
                    {
                        no:2,
                        name:'1000-1999'
                    },
                    {
                        no:3,
                        name:'2000-3999'
                    },
                    {
                        no:4,
                        name:'>3999'
                    },
                ],
                sortInfo:[
                    {
                        no:1,
                        name:'最新'
                    },
                    {
                        no:2,
                        name:'销量'
                    },
                    {
                        no:3,
                        name:'价格'
                    }
                ],
                categoryIndex: 1,
                priceIndex:0,
                sortIndex:0
            }
        }
    }
</script>

<style>
    #searchGoods{
        width: 100%;
        height: 800px;
        margin-top: 10px;
        border: 1px solid #333;
    }
    .sg-screenBox{
        width: 100%;
        height: 200px;
        border-bottom: 1px solid #aaa;
    }
    .sg-screenBox>ul{
        width: 95%;
        height: 50px;
        margin: 10px auto;
        border-bottom: 1px solid #ccc;
    }
    .sg-screenBox>ul:last-of-type{
        border-bottom: none;
    }
    .sg-screenBox>ul li{
        float: left;
        width: 150px;
        font-size: 18px;
        line-height: 50px;
        list-style-type: none;
        border: 1px solid #333;
        color: #666;
    }
    .sg-screenBox>ul li:nth-of-type(n+2){
        cursor: pointer;
        color: #333;
    }
    .sg-screenBox>ul li:nth-of-type(n+2):hover{
        color: crimson;
    }
    .sg-screenBox>ul .select{
        color: crimson !important;
    }
</style>