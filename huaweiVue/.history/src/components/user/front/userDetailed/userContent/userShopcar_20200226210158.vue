<template>
    <div id="userShopcar">
        <div class="us-header">
            <div class="us-sel">
                <div class="selBox">
                    <div>√</div>
                </div>
                <span>全选</span>
            </div>
        </div>
        <div class="us-content">

        </div>
    </div>
</template>


<style>
    #userShopcar{
        width: 100%;
        height: 100%;
    }
    .us-header{
        width: 100%;
        height: 40px;
        background: #f5f5f5;
    }
    .us-header>div{
        float: left;
        margin-left: 30px;
    }
    .us-sel>div{
        float: left;
        width: 20px;
        height: 20px;
        margin-top: 10px;
        border: 1px solid #333;
    }
    .selBox{
        position: relative;
    }
    .selBox>div{
        position: absolute;
        top: 0px;
        left: 0px;
        width: 18px;
        height: 18px;
        background: #ff0036;
    }
    .us-sel>span{
        font-size: 16px;
        line-height: 40px;
        margin-left: 5px;
    }
</style>