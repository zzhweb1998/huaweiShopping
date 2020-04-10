<template>
    <div id="goodsDetailed">
        <div class="gd-box">
            <div class="gd-bLeft">
                <div class="gd-browseBox">

                </div>
                <div class="gd-browseBox">

                </div>
            </div>
            <div class="gd-bRight">

            </div>
        </div>
    </div>
</template>


<style>
    #goodsDetailed{
        width: 100%;
        height: auto;
        margin-top: 10px;
        border: 1px solid #333;
    }
    .gd-box{
        width: 100%;
        height: 600px;
        border: 1px solid #333
    }
    .gd-bLeft{
        float: left;
        width: 35%;
        height: 100%;
        border:1px solid #333
    }
    .gd-bRight{
        float: right;
        width: 64%;
        height: 100%;
        border: 1px solid #333;
    }
    .gd-browseBox{
        width: 450px;
        height: 450px;
        margin: 0 auto;
        border: 1px solid #333;
    }
    .gd-browseMin{
        width: 450px;
        height: 100px;
    }
</style>