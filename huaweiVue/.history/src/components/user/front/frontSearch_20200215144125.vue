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
        width: 678px;
    }
    .fs-categoryBox>div{
        width: 80px;
        height: 100%;
        float: left;
        margin-left: 10px;
    }
    .searchBox{
        width: 300px;
    }
</style>

