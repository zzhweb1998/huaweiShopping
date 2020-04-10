<template>
    <div id="manageCarousel">
        <div class="ac-header">
            轮播图管理
        </div>
        <div class="mc-box">
            <div class="mc-operate">
                <div>
                    <span>轮播顺序：</span>
                </div>
                <div>
                    <span>轮播图片：</span>
                </div>
                <div>
                    <span>轮播小图：</span>
                </div>
                <div>
                    <span>商品ID：</span>
                </div>
            </div>
        </div>
    </div>
</template>


<style>
    #manageCarousel{
        width: 100%;
        height: 100%;
    }
    .ac-header{
        width: 100%;
        height: 60px;
        background: #eee;
        font-size: 26px;
        font-weight: 600;
        line-height: 60px;
        text-indent: 100px;
        color: #555;
    }
    .mc-box{
        width: 100%;
        height: 600px;
        border: 1px solid #333;
    }
    .mc-operate{
        width: 300px;
        height: 100%;
        border: 1px solid #333;
    }
    .mc-operate>div{
        width: 100%;
        height: 40px;
        margin-top: 10px;
        border: 1px solid #333;
    }
</style>