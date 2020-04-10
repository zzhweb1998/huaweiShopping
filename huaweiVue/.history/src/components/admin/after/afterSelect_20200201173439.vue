<template>
    <div id="afterSelect">
        <div class="as-content">
            <ul v-for="(sel,index) in selectData" :key="index">
                <div class="as-title">{{sel.title}}</div>
                <li v-for="(con,index2) in sel.con" :key="index2" v-show="sel.index == index">{{con}} ></li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                selectData:[
                    {
                        title: '管理员管理',
                        index: 0,
                        con: [
                            '管理员信息',
                            '添加管理员',
                        ]
                    },
                    {
                        title: '用户管理',
                        index: 1,
                        con: [
                            '用户信息',
                            '添加用户',
                        ]
                    },
                    {
                        title: '商品管理',
                        index: 2,
                        con: [
                            '商品信息',
                            '添加商品',
                        ]
                    },
                    {
                        title: '图片管理',
                        index: 3,
                        con: [
                            '商品浏览图',
                            '商品详情图',
                        ]
                    },
                    {
                        title: '进货管理',
                        index: 4,
                        con: [
                            '进货信息',
                            '商品进货',
                        ]
                    },
                    {
                        title: '订单管理',
                        index: 5,
                        con: [
                            '订单信息',
                        ]
                    },
                ],
                selectIf: ''
            }
        }
    }
</script>

<style>
    #afterSelect{
        width: 15%;
        height: 100%;
        float: left;
        border: 1px solid #333;
    }
    .as-content{
        width: 200px;
        height: 90%;
        margin: 20px auto;
    }
    .as-content ul{
        width: 100%;
        height: auto;
    }
    .as-title{
        width: 100%;
        height: 40px;
        border: 1px solid #333;
        font-size: 20px;
        line-height: 40px;
        text-indent: 20px;
        background: #eee;
    }
    .as-content li{
        list-style: none;
        width: 100%;
        height: 30px;
        font-size: 18px;
        border: 1px solid #555;
        color: #555;
        text-indent: 40px;
        cursor: pointer;
   }
</style>