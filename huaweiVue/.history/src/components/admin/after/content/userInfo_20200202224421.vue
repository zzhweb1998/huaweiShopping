<template>
    <div id="userInfo">
        <div class="ac-header">
            用户信息
        </div>
        <div class="ac-search">
            <span>用户账号：</span>
            <input type="text" v-model="keyword">
            <button @click="search">查询</button>
            <button @click="pageAdd">添加</button>
        </div>
        <div class="ac-table">
            <table border="1" cellspacing="0" cellpadding="0">
                <tr>
                    <th>账号</th>
                    <th>密码</th>
                    <th>邮箱</th>
                    <th>余额</th>
                    <th>会员等级</th>
                    <th>操作</th>
                </tr>
                <tr v-for="(sd,index) in showData" :key="index">
                    <td>{{sd.user_account}}</td>
                    <td>{{sd.user_password}}</td>
                    <td>{{sd.user_email}}</td>
                    <td>{{sd.user_money}}</td>
                    <td>{{sd.user_Grade}}</td>
                    <td>
                        <button class="ac-operate">修改</button>
                        <button class="ac-operate">删除</button>
                    </td>
                </tr>
            </table>
            <el-pagination background layout="prev, pager, next" :total="pageTotal" 
            :page-sizes="8" class="ac-page">
            </el-pagination>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                conInfo: '',
                showData: '',
                keyword: '',
                pageTotal: 0
            }
        },
        created() {
            this.axios.post("/api/shop/user", {
                gradeIf: 0
            }).then(res => {
                this.conInfo = res.data
                this.showData = this.conInfo
                this.pageTotal = this.showData.length * 10
                console.log(this.pageTotal);
                
            })
        },
        methods: {
            pageAdd() {
                this.$router.push('/admin/userAdd')
            },
            search() {
                if (this.keyword == '' || this.keyword == null) {
                    this.showData = this.conInfo
                } else {
                    this.showData = this.conInfo.filter(item => {
                        if (item.user_account.includes(this.keyword.trim())) {
                            return item
                        }
                    })
                    this.keyword = ''
                }
            }
        }
    }
</script>


<style>
    #userInfo {
        width: 100%;
        height: 100%;
    }

    .ac-header {
        width: 100%;
        height: 60px;
        background: #eee;
        font-size: 26px;
        font-weight: 600;
        line-height: 60px;
        text-indent: 60px;
        color: #555;
    }

    .ac-search {
        width: 100%;
        height: 60px;
        font-size: 20px;
        line-height: 60px;
        text-indent: 150px;
        border-bottom: 1px solid #ccc;
    }

    .ac-search>input[type=text] {
        width: 200px;
        height: 30px;
        font-size: 20px;
        text-indent: 5px;
        outline: none;
    }

    .ac-search>button {
        width: 80px;
        height: 30px;
        margin-left: 10px;
        font-size: 16px;
    }

    .ac-table {
        width: 100%;
        height: 510px;
        margin-top: 10px;
    }

    .ac-table>table {
        width: 90%;
        margin: 0 auto;
    }

    .ac-table tr {
        height: 30px;
        text-align: center;
    }

    .ac-operate {
        width: 60px;
        font-size: 14px;
    }
    .ac-page{
        float: right;
        margin-top: 10px;
        margin-right: 50px;
    }
</style>