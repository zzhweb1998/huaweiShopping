<template>
    <div id="frontSearch">
        <div class="fs-pictrueBox">
            <img src="../../../image/SXppnESYv4K11DBxDFc2.png" alt="">
        </div>
        <div class="fs-categoryBox">
            <div v-for="(cg,index) in category" :key="index">
                <p>{{cg.name}}</p>
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
                ]
            }
        },
        methods:{

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
        border: 1px solid #333;
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
    .searchBox{
        width: 330px;
    }
    .sb-border{
        width: 300px;
        height: 40px;
        border: 1px solid #999;
        margin-top: 30px;
        margin-left: 10px;
    }
    .sb-border>input[type=text]{
        width: 200px;
        height: 35px;
        margin-left: 10px;
        margin-top: 1px;
        outline: none;
    }
    .sb-border>button{
        width: 80px;
        height: 100%;
        border: none;
        outline: none;
        background: #ff0036;
    }
</style>

