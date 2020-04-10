<template>
    <div id="searchGoods">
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
                <div class="risePrice"></div>
                <div class="dropPrice"></div>
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
                categoryIndex: 0,
                priceIndex:0,
                sortIndex:0
            }
        },
        methods:{
            selectIndex(sel,index){
                if(sel == 1){
                    this.categoryIndex = index
                }else if(sel == 2){
                    this.priceIndex = index
                }else if(sel == 3){
                    this.sortIndex = index
                }
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
    .select{
        color: crimson !important;
    }
    .sg-screenBox>.sg-sort{
        position: relative;
    }
    .risePrice{
        position: absolute;
        top: 13px;
        left: 490px;
        content: '';
        display: block;
        border-width: 5px;
        border-style: solid;
        border-color: #fff #fff #333 #fff;
    }
    .dropPrice{
        position: absolute;
        top: 17px;
        left: 490px;
        content: '';
        display: block;
        border-width: 5px;
        border-style: solid;
        border-color: #fff #fff #333 #fff;
    }
</style>