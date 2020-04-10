<template>
    <div id="afterSelect">
        <div class="as-content">
            
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
                        con: [
                            '管理员信息',
                            '添加管理员',
                            '修改管理员信息'
                        ]
                    },
                    {
                        title: '用户管理',
                        con: [
                            '用户信息',
                            '添加用户',
                            '修改用户信息'
                        ]
                    },
                    {
                        title: '商品',
                        con: [
                            '商品信息',
                            '添加商品',
                            '修改商品信息'
                        ]
                    },
                    {
                        title: '管理员',
                        con: [
                            '管理员信息',
                            '添加管理员',
                            '修改管理员信息'
                        ]
                    },
                    {
                        title: '管理员',
                        con: [
                            '管理员信息',
                            '添加管理员',
                            '修改管理员信息'
                        ]
                    },
                    {
                        title: '管理员',
                        con: [
                            '管理员信息',
                            '添加管理员',
                            '修改管理员信息'
                        ]
                    },
                ]
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
        border: 1px solid #333;
    }
</style>