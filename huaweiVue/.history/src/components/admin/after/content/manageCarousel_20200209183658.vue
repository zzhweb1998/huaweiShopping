<template>
    <div id="manageCarousel">
        <div class="ac-header">
            轮播图管理
        </div>
        <div class="mc-box">
            <div class="mc-operate">
                <div>
                    <span>轮播顺序：</span>
                    <el-select v-model="carouselOrder" placeholder="请选择">
                        <el-option v-for="item in order" :key="item.value" :label="item.label" :value="item.value">
                        </el-option>
                    </el-select>
                </div>
                <div>
                    <span>轮播图片：</span>
                    <input type="file" >
                </div>
                <div>
                    <span>轮播小图：</span>
                    <input type="file" >
                </div>
                <div>
                    <span>商 品 ID ：</span>
                    <input type="text">
                </div>
                <button>确 定</button>
            </div>
            <div class="mc-content">
                <div v-for="(ci,index) in carouselInfo" :key="index">
                    <img src="" alt="">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                carouselOrder: '',
                carouselPicture:'',
                carouselMin:'',
                carouselGoods:'',
                order: [
                    {
                        value: 1,
                        label: 1
                    },
                    {
                        value: 2,
                        label: 2
                    },
                    {
                        value: 3,
                        label: 3
                    },
                ],
                carouselInfo:[
                    {
                        id:1,
                        name:'',
                        min:'',
                        goods:''
                    },
                    {
                        id:2,
                        name:'',
                        min:'',
                        goods:''
                    },
                    {
                        id:3,
                        name:'',
                        min:'',
                        goods:''
                    },
                ]
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
        width: 32%;
        height: 100%;
        float: left;
        border: 1px solid #333;
    }
    .mc-operate>div{
        width: 100%;
        height: 60px;
        margin-top: 10px;
        line-height: 60px;
        border: 1px solid #333;
    }
    .mc-operate>div span{
        font-size: 20px;
        margin-left: 20px;
    }
    .mc-operate>div input[type=text]{
        width: 110px;
        height: 40px;
    }
    .mc-operate>button{
        width: 100px;
        height: 40px;
        font-size: 20px;
        margin-left: 200px;
        margin-top: 10px;
    }
    .el-select-dropdown {
        height: auto !important;
    }

    .mc-operate>div .el-input__inner {
        width: 110px;
        height: 40px;
    }

    .mc-content{
        width: 67%;
        height: 100%;
        float: left;
        border: 1px solid #333;
        margin-left: 5px;
    }
    .mc-content>div{
        width: 100%;
        height: 30%;
        border: 1px solid #333;
        margin-top: 10px;
    }
    .mc-content>div>img{
        width: 500px;
        height: 100px;
        display: inline-block;
        border: 1px solid #333;
    }
</style>