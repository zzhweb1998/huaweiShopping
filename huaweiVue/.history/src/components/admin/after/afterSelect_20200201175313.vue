<template>
    <div id="afterSelect">
        <div class="as-content">
            <ul v-for="(sel,index) in selectData" :key="index">
                <div class="as-title" @click="select(index)">{{sel.title}}</div>
                <li v-for="(con,index2) in sel.con" :key="index2" v-show="index == selectIf-1" 
                @click="cutPage(con.path)">{{con.name}} ></li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                selectData: [
                    {
                        title: '管理员管理',
                        con: [
                            {
                                name: '管理员信息',
                                path: 'adminInfo'
                            },
                            {
                                name: '添加管理员',
                                path: 'adminInfo'
                            },
                        ]
                    },
                    {
                        title: '用户管理',
                        con: [
                            {
                                name: '用户信息',
                                path: 'adminInfo'
                            },
                            {
                                name: '添加用户',
                                path: 'adminInfo'
                            },
                        ]
                    },
                    {
                        title: '商品管理',
                        con: [
                            {
                                name: '商品信息',
                                path: 'adminInfo'
                            },
                            {
                                name: '添加商品',
                                path: 'adminInfo'
                            },
                        ]
                    },
                    {
                        title: '图片管理',
                        con: [
                            {
                                name: '商品浏览图',
                                path: 'adminInfo'
                            },
                            {
                                name: '商品详情图',
                                path: 'adminInfo'
                            },
                        ]
                    },
                    {
                        title: '进货管理',
                        con: [
                            {
                                name: '进货信息',
                                path: 'adminInfo'
                            },
                            {
                                name: '商品进货',
                                path: 'adminInfo'
                            },
                        ]
                    },
                    {
                        title: '订单管理',
                        con: [
                            '订单信息',
                            {
                                name: '订单信息',
                                path: 'adminInfo'
                            },
                        ]
                    },
                ],
                selectIf: 0
            }
        },
        methods: {
            select(index) {
                if (this.selectIf == index + 1) {
                    this.selectIf = 0
                } else {
                    this.selectIf = index + 1
                }
            },
            cutPage(path){
                let page = '/admin/'.path
                this.$router.push(page)
            }
        }
    }
</script>

<style>
    #afterSelect {
        width: 15%;
        height: 100%;
        float: left;
        border: 1px solid #333;
    }

    .as-content {
        width: 200px;
        height: 90%;
        margin: 20px auto;
    }

    .as-content ul {
        width: 100%;
        height: auto;
    }

    .as-title {
        width: 100%;
        height: 40px;
        border: 1px solid #333;
        font-size: 20px;
        line-height: 40px;
        text-indent: 20px;
        background: #eee;
    }

    .as-content li {
        list-style: none;
        width: 100%;
        height: 30px;
        border: 1px solid #555;
        text-indent: 40px;
        cursor: pointer;
    }

    .as-content li>a {
        font-size: 18px;
        color: #555;
    }

    .as-content li>a:hover {
        color: #444;
    }
</style>