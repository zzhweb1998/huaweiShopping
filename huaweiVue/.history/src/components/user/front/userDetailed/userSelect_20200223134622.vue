<template>
    <div id="userSelect">
        <ul>
            <li>
                <span>用户信息</span>
                <span>></span>
            </li>
        </ul>
    </div>
</template>

<script>
    export default{
        data(){
            return{

            }
        }
    }
</script>

<style>
    #userSelect{
        width: 250px;
        height: 100%;
        float: left;
        border: 1px solid #333;
    }
    #userSelect ul{
        width: 100%;
        height: 100%;
        border: 1px solid #333;
    }
    #userSelect li{
        list-style-type: none;
        width: 200px;
        height: 40px;
        margin: 10px auto;
        font-size: 20px;
        text-align: center;
        line-height: 40px;
        border: 1px solid #333;
    }
    #userSelect li>span:nth-of-type(2){
        float: right;
        margin-right: 30px;

    }
</style>