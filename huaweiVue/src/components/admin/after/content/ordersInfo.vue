<template>
    <div id="ordersInfo">
        <div class="oi-header">
            订单信息
        </div>
        <div class="oi-search">
            <span>订单编号：</span>
            <input type="text" v-model="keyword">
            <button @click="search">查询</button>
            <span>筛选订单：</span>
            <button v-for="(si,index) in selInfo" :class="{'selKey':si.no == selIndex}" :key="index"
                @click="selScreen(si.no)">{{si.name}}</button>
        </div>
        <div class="oi-table">
            <table border="1" cellspacing="0" cellpadding="0">
                <tr>
                    <th>订单编号</th>
                    <th>用户账号</th>
                    <th>下单时间</th>
                    <th>付款时间</th>
                    <th>订单总额</th>
                    <th>订单状态</th>
                    <th>操作</th>
                </tr>
                <tr v-for="(ps,index) in pageShow[pageCurrent]" :key="index">
                    <td>{{ps.orders_no}}</td>
                    <td>{{ps.user_account}}</td>
                    <td>{{ps.create_time}}</td>
                    <td>{{ps.pay_time}}</td>
                    <td>{{ps.total_price}}</td>
                    <td>
                        <p v-for="(ss,index) in statusShow" :key="index" v-show="ss.no == ps.orders_status">
                            {{ss.status}}</p>
                    </td>
                    <td>
                        <button class="oi-operate" @click="detailedPage(ps.orders_no)">订单详情</button>
                    </td>
                </tr>
            </table>
            <el-pagination background layout="prev, pager, next" :total="pageTotal" :page-size="pageSize"
                @current-change="currentChange" class="oi-page">
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
                pageShow: [], //当前页显示数据
                statusShow: [
                    {
                        no: 0,
                        status: '待付款'
                    },
                    {
                        no: 1,
                        status: '已付款'
                    },
                    {
                        no: 2,
                        status: '已取消'
                    },
                    {
                        no: 3,
                        status: '已发货'
                    },
                    {
                        no: 4,
                        status: '已收货'
                    },
                ],
                selInfo: [
                    {
                        no: 1,
                        name: '全部订单'
                    },
                    {
                        no: 2,
                        name: '待付款'
                    },
                    {
                        no: 3,
                        name: '待发货'
                    },
                    {
                        no: 4,
                        name: '待收货'
                    },
                    {
                        no: 5,
                        name: '已完成'
                    },
                    {
                        no: 6,
                        name: '已取消'
                    },
                ],
                selIndex: 1,
                selScreenData: ''
            }
        },
        created() {
            this.axios.post("/api/shop/ordersDetailed").then(res => {
                this.conInfo = res.data
                this.selScreenData = this.conInfo
                this.showData = this.selScreenData
                this.pageTotal = this.showData.length
                for (let i = 0; i < this.pageTotal / this.pageSize; i++) {
                    this.pageShow[i] = this.showData.slice(this.pageSize * i, this.pageSize * (i + 1))
                }
            })
        },
        methods: {
            detailedPage(no) {
                this.$router.push({ path: '/admin/ordersDetailed', query: { ordersno: no } })
            },
            search() {
                if (this.keyword == '' || this.keyword == null) {
                    this.showData = this.conInfo
                    this.pageUp()
                } else {
                    this.showData = this.conInfo.filter(item => {
                        if (item.orders_no.includes(this.keyword.trim())) {
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
            },
            selScreen(no) {
                if (this.selIndex != no) {
                    this.selIndex = no
                    this.selScreenData = []
                    this.pageShow = []
                    if (this.selIndex == 1) {
                        this.selScreenData = this.conInfo
                        this.showData = this.selScreenData
                        this.pageUp()
                    } else if (this.selIndex == 2) {
                        this.conInfo.filter(item => {
                            if (item.orders_status == 0) {
                                this.selScreenData.push(item)
                            }
                        })
                        this.showData = this.selScreenData
                        this.pageUp()
                    } else if (this.selIndex == 3) {
                        this.conInfo.filter(item => {
                            if (item.orders_status == 1) {
                                this.selScreenData.push(item)
                            }
                        })
                        this.showData = this.selScreenData
                        this.pageUp()
                    } else if (this.selIndex == 4) {
                        this.conInfo.filter(item => {
                            if (item.orders_status == 3) {
                                this.selScreenData.push(item)
                            }
                        })
                        this.showData = this.selScreenData
                        this.pageUp()
                    } else if (this.selIndex == 5) {
                        this.conInfo.filter(item => {
                            if (item.orders_status == 4) {
                                this.selScreenData.push(item)
                            }
                        })
                        this.showData = this.selScreenData
                        this.pageUp()
                    } else if (this.selIndex == 6) {
                        this.conInfo.filter(item => {
                            if (item.orders_status == 2) {
                                this.selScreenData.push(item)
                            }
                        })
                        this.showData = this.selScreenData
                        this.pageUp()
                    }
                }
            },
        }
    }
</script>

<style>
    #ordersInfo {
        width: 100%;
        height: 100%;
    }

    .oi-header {
        width: 100%;
        height: 60px;
        background: #eee;
        font-size: 26px;
        font-weight: 600;
        line-height: 60px;
        text-indent: 100px;
        color: #555;
    }

    .oi-search {
        width: 100%;
        height: 60px;
        font-size: 20px;
        line-height: 60px;
        text-indent: 50px;
        border-bottom: 1px solid #ccc;
    }

    .oi-search>input[type=text] {
        width: 200px;
        height: 30px;
        font-size: 20px;
        text-indent: 5px;
        outline: none;
    }

    .oi-search>button {
        width: 80px;
        height: 30px;
        font-size: 16px;
    }

    .oi-search>span:nth-of-type(2) {
        margin-left: 50px;
    }

    .oi-search>button:nth-of-type(1) {
        margin-left: 10px;
    }

    .oi-search>button:nth-of-type(n+2) {
        margin-left: 5px;
        outline: none;
        border: none;
        color: #666;
        background: #ccc;
    }

    .oi-search>.selKey {
        color: #f9f9f9 !important;
        background: #444 !important;
    }

    .oi-search>button:nth-of-type(n+2):hover {
        color: #f9f9f9;
        background: #444;
    }

    .oi-table {
        width: 100%;
        height: 510px;
        margin-top: 10px;
    }

    .oi-table>table {
        width: 90%;
        margin: 0 auto;
    }

    .oi-table tr {
        height: 30px;
        text-align: center;
    }

    .oi-operate {
        width: 60px;
        font-size: 14px;
    }

    .oi-page {
        float: right;
        margin-top: 10px;
        margin-right: 50px;
    }
</style>