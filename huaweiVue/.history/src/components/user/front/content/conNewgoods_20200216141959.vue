<template>
    <div id="conNewgoods">
        <div class="ng-box">
            <div class="ng-img">
                <img src="" alt="">
            </div>
            <p class="ng-name">xxxx</p>
            <p class="ng-title">xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</p>
            <p class="ng-price">xxxxx</p>
        </div>
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
    #conNewgoods{
        width: 1300px;
        height: 620px;
        border: 1px solid #333;
        margin-top: 20px;
    }
    .ng-box{
        width: 250px;
        height: 300px;
        text-align: center;
        background: #f9f9f9;
        cursor: pointer;
        border: 1px solid #ccc;
    }
    .ng-box:hover{
        background: #fefefc;
    }
    .ng-img{
        width: 170px;
        height: 170px;
        margin: 10px auto;
        border: 1px solid #333;
    }
    .ng-name{
        font-size: 24px;
        color: #333;
    }
    .ng-title{
        width: 90%;
        margin: 5px auto;
        font-size: 18px;
        color: #888;
        text-align: center;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .ng-price{
        font-size: 18px;
        color: crimson;
    }
</style>