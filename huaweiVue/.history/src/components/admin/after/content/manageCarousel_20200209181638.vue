<template>
    <div id="manageCarousel">
        <div class="ac-header">
            轮播图管理
        </div>
        <div class="mc-box">
            <div class="mc-operate">
                <div>
                    <span>轮播顺序：</span>
                    <el-select v-model="goodsCategory" placeholder="请选择">
                        <el-option v-for="item in options" :key="item.value" :label="item.label" :value="item.value">
                        </el-option>
                    </el-select>
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

<script>
    export default{
        data(){
            return{
                options: [
                    {
                        value: 'Mate',
                        label: 'Mate'
                    },
                    {
                        value: 'P',
                        label: 'P'
                    },
                    {
                        value: 'nova',
                        label: 'nova'
                    },
                    {
                        value: '畅享',
                        label: '畅享'
                    }
                ],
            }
        }
    }
</script>

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
        line-height: 40px;
        border: 1px solid #333;
    }



    .el-select-dropdown {
        height: auto !important;
    }

    .mc-operate>div .el-input__inner {
        width: 80px;
        height: 40px;
    }
</style>