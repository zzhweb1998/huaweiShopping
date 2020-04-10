<template>
    <div id="frontSearch">
        <div class="fs-pictrueBox">
            <img src="../../../image/SXppnESYv4K11DBxDFc2.png" alt="">
        </div>
        <div class="fs-categoryBox">
            <div v-for="(cg,index) in category" :key="index" @mouseover="over(cg.no)" @mouseleave="leave">
                <p>{{cg.name}}</p>
                <div class="cb-content" v-show="showIf == cg.no">
                    {{cg.no}}
                </div>
            </div>
        </div>
        <div class="searchBox">
            <div class="sb-border">
                <input type="text" name="" id="">
                <button>搜索</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                category:[
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
                showIf: 0
            }
        },
        methods:{
            over(no){
                this.showIf == no
            },
            leave(){
                this.showIf == 0
            }
        }
    }
</script>

<style>
    #frontSearch{
        width: 100%;
        height: 100px;
        margin-top: 10px;
    }
    #frontSearch>div{
        height: 100%;
        float: left;
    }
    .fs-pictrueBox{
        width: 320px;
    }
    .fs-pictrueBox>img{
        width: 250px;
        height: auto;
        margin-top: 25px;
        margin-left: 30px;
    }
    .fs-categoryBox{
        position: relative;
        width: 650px;
    }
    .fs-categoryBox>div{
        width: 100px;
        height: 50px;
        float: left;
        font-size: 22px;
        cursor: pointer;
        margin-top: 30px;
        border-right: 1px solid #ccc;
    }
    .fs-categoryBox>div p{
        line-height: 50px;
        text-align: center;
    }
    .fs-categoryBox>div p:hover{
        color: crimson;
    }
    .cb-content{
        position: absolute;
        top: 80px;
        left: -160px;
        width: 800px;
        height: 200px;
        border: 1px solid #ccc;
        background: #fff;
        z-index: 10px;
    }
    .searchBox{
        width: 330px;
    }
    .sb-border{
        position: relative;
        width: 300px;
        height: 40px;
        border: 1px solid #999;
        margin-top: 35px;
        margin-left: 10px;
    }
    .sb-border>input[type=text]{
        width: 200px;
        height: 36px;
        margin-left: 10px;
        border: none;
        outline: none;
    }
    .sb-border>button{
        position: absolute;
        top: -1px;
        right: 0;
        width: 80px;
        height: 40px;
        padding: 0px;
        border: none;
        outline: none;
        cursor: pointer;
        margin-left: 3px;
        background: #ff0036;
    }
</style>

