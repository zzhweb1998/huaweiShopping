<template>
    <div id="userInfo">
        <div class="ac-header">
            用户信息
        </div>
        <div class="ac-search">
            <span>用户账号：</span>
            <input type="text" v-model="keyword">
            <button @click="search">查询</button>
            <button @click="addPage">添加</button>
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
                <tr v-for="(ps,index) in pageShow[pageCurrent]" :key="index">
                    <td>{{ps.user_account}}</td>
                    <td>{{ps.user_password}}</td>
                    <td>{{ps.user_email}}</td>
                    <td>{{ps.user_money}}</td>
                    <td>{{ps.user_Grade}}</td>
                    <td>
                        <button class="ac-operate" @click="updatePage(ps.user_account)">修改</button>
                        <button class="ac-operate" @click="detele(ps.user_account)">删除</button>
                    </td>
                </tr>
            </table>
            <el-pagination background layout="prev, pager, next" :total="pageTotal" :page-size="pageSize"
                @current-change="currentChange" class="ac-page">
            </el-pagination>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                conInfo: '',  //内容数据
                showData: '', //需要的内容数据
                keyword: '', //关键字
                pageTotal: 0, //总数据量
                pageCurrent: 0, //当前页数
                pageSize: 8,  //每页显示数量
                pageShow: [] //当前页显示数据
            }
        },
        created() {
            this.axios.post("/api/shop/user", {
                gradeIf: 0
            }).then(res => {
                this.conInfo = res.data
                this.showData = this.conInfo
                this.pageTotal = this.showData.length

                for (let i = 0; i < this.pageTotal / this.pageSize; i++) {
                    this.pageShow[i] = this.showData.slice(this.pageSize * i, this.pageSize * (i + 1))
                }
            })
        },
        methods: {
            addPage() {
                this.$router.push('/admin/userAdd')
            },
            updatePage(acc){
                this.$router.push({path:'/admin/userUpdate',query:{account:acc}})
            },
            detele(acc){
                let delIf = confirm('是否要删除此用户')
                if(delIf == true){
                    this.axios.post("/api/shop/delUser",{
                        account: acc
                    }).then(res => {
                        if(res.data == 1){
                            alert('用户删除成功')
                        }else{
                            alert('用户删除失败')
                        }
                    })
                }
            },
            search() {
                if (this.keyword == '' || this.keyword == null) {
                    this.showData = this.conInfo
                    this.pageUp()
                } else {
                    this.showData = this.conInfo.filter(item => {
                        if (item.user_account.includes(this.keyword.trim())) {
                            return item
                        }
                    })
                    this.pageUp()
                    this.keyword = ''
                }
            },
            currentChange(val) {
                this.pageCurrent = val - 1
            },
            pageUp() {
                this.pageTotal = this.showData.length
                for (let i = 0; i < this.pageTotal / this.pageSize; i++) {
                    this.pageShow[i] = this.showData.slice(this.pageSize * i, this.pageSize * (i + 1))
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

    .ac-page {
        float: right;
        margin-top: 10px;
        margin-right: 50px;
    }
</style>