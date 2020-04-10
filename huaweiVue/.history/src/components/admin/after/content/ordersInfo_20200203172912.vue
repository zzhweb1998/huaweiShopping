<template>
    <div id="ordersInfo">
        <div class="ac-header">
            订单信息
        </div>
        <div class="ac-search">
            <span>订单编号：</span>
            <input type="text" v-model="keyword">
            <button @click="search">查询</button>
        </div>
        <div class="ac-table">
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
                    <td>{{ps.orders_status}}</td>
                    <td>
                        <button class="ac-operate" @click="detailedPage">订单详情</button>
                    </td>
                </tr>
            </table>
            <el-pagination background layout="prev, pager, next" :total="pageTotal" :page-size="8"
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
            pageShow: [], //当前页显示数据
            statusShow:[
                {
                    no:0,
                    status:'待付款'
                },
                {
                    no:1,
                    status:'已付款'
                },
                {
                    no:2,
                    status:'已取消'
                },
                {
                    no:3,
                    status:'已发货'
                },
                {
                    no:4,
                    status:'已收货'
                },
            ]
        }
    },
    created() {
        this.axios.post("/api/shop/ordersDetailed").then(res => {
            this.conInfo = res.data.reverse()
            this.showData = this.conInfo
            this.pageTotal = this.showData.length
            for (let i = 0; i < this.pageTotal / this.pageSize; i++) {
                this.pageShow[i] = this.showData.slice(this.pageSize * i, this.pageSize * (i + 1))
            }
        })
    },
    methods: {
        detailedPage(){
            this.$router.push('/admin/ordersDetailed')
        },
        search() {
            if (this.keyword == '' || this.keyword == null) {
                this.showData = this.conInfo
                this.pageUp()
            } else {
                this.showData = this.conInfo.filter(item => {
                    if (item.orders_no.toUpperCase().includes(this.keyword.trim().toUpperCase())) {
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
    #ordersInfo{
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