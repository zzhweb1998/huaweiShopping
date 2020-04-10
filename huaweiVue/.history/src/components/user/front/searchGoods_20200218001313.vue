<template>
    <div id="searchGoods">
        <div class="sg-screenBox">
            <ul class="sg-category">

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
</style>