<template>
    <div id="goodsDetailed">
        <div class="gd-box">
            <div class="gd-bLeft">
                <div class="gd-browseBox">
                    <div class="browse-show">

                    </div>
                    <div class="browse-min">

                    </div>
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
        height: 100%;
        margin: 0 auto;
        border: 1px solid #333;
    }
    .browse-show{
        width: 100%;
        height: 450px;
        border: 1px solid #333;
    }
    .browse-min{
        width: 100%;
        height: 100px;
        border: 1px solid #333;
    }
</style>