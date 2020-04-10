<template>
    <div id="searchGoods">
        <div class="sg-screenBox">
            <ul class="sg-category">
                <li>分类：</li>
                <li v-for="(ci,index) in categoryInfo" :key="index">{{ci.name}}</li>
            </ul>
            <ul class="sg-category">
                <li>价格区间：</li>
                <li v-for="(ci,index) in categoryInfo" :key="index">{{ci.name}}</li>
            </ul>
            <ul class="sg-category">
                <li>排序：</li>
                <li v-for="(ci,index) in categoryInfo" :key="index">{{ci.name}}</li>
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
                ]
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
        height: 300px;
        border: 1px solid #333;
    }
    .sg-category{
        width: 95%;
        height: 50px;
        margin: 10px auto;
        border: 1px solid #333;
    }
    .sg-category li{
        float: left;
        width: 100px;
        line-height: 50px;
        list-style-type: none;
        color: #666;
    }
    .sg-category li:nth-of-type(n+2){
        margin-left: 50px;
        cursor: pointer;
        color: #333;
    }
    .sg-category li:nth-of-type(n+2):hover{
        color: crimson;
    }
</style>