<template>
    <div id="adminStatistics">
        <div class="as-header">
            后台数据统计
        </div>
        <div class="as-select">
            <div class="block">
                <span class="demonstration">选择查询日期</span>
                <el-date-picker v-model="value" type="date" placeholder="选择日期" value-format="yyyy-MM-dd">
                </el-date-picker>
            </div>
            <div class="baseInfo">
                <span>{{baseInfo.date}}完成订单:</span>
                <span>销售商品总数：{{baseInfo.num}}</span>
                <span>销售总额：{{baseInfo.total}}</span>
                <span>总盈利额：{{baseInfo.profit}}</span>
            </div>
        </div>
        <div class="as-table">
            <table border="1" cellspacing="0" cellpadding="0">
                <tr>
                    <th>订单编号</th>
                    <th>商品名称</th>
                    <th>商品颜色</th>
                    <th>商品配置</th>
                    <th>商品数量</th>
                    <th>商品价格</th>
                    <th>进货价格</th>
                    <th>盈利金额</th>
                    <th>收货时间</th>
                    <th>订单商品状态</th>
                </tr>
                <tr v-for="(ps,index) in pageShow[pageCurrent]" :key="index">
                    <td>{{ps.orders_no}}</td>
                    <td>{{ps.goods_info_name}}</td>
                    <td>{{ps.goods_color}}</td>
                    <td>{{ps.goods_configure}}</td>
                    <td>{{ps.goods_num}}</td>
                    <td>{{ps.price}}</td>
                    <td>{{ps.stock_price}}</td>
                    <td>{{ps.profit}}</td>
                    <td>{{ps.receive_time}}</td>
                    <td v-for="sta in status" v-if="sta.no == ps.shopcar_status">{{sta.name}}</td>
                </tr>
            </table>
            <el-pagination background layout="prev, pager, next" :total="pageTotal" :page-size="pageSize"
                @current-change="currentChange" class="as-page">
            </el-pagination>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                value: '',
                conInfo: '',  //内容数据
                showData: '', //需要的内容数据
                pageTotal: 0, //总数据量
                pageCurrent: 0, //当前页数
                pageSize: 8,  //每页显示数量
                pageShow: [], //当前页显示数据
                baseInfo: {
                    date: '所有',
                    num: 0,
                    total: 0.00,
                    profit: 0.00
                },
                status: [
                    {
                        no: 3,
                        name: '正常'
                    },
                    {
                        no: 4,
                        name: '申请退款'
                    },
                    {
                        no: 5,
                        name: '取消退款'
                    },
                    {
                        no: 6,
                        name: '退款失败'
                    },
                    {
                        no: 8,
                        name: '退款成功'
                    },
                ]
            };
        },
        created() {
            this.gainStatistics()
        },
        watch: {
            value(newval, oldval) {
                if (this.value == "" || this.value == null) {
                    this.baseInfo.date = '所有'
                    this.gainStatistics()
                } else {
                    this.baseInfo.date = this.value
                    this.filterData(this.baseInfo.date)
                }
            }
        },
        methods: {
            currentChange(val) {
                this.pageCurrent = val - 1
            },
            gainStatistics() {
                this.axios.post("/api/shop/statistics").then(res => {
                    this.conInfo = res.data.reverse()
                    this.showData = res.data.reverse()
                    this.editData()
                    this.pageUp()
                });

            },
            pageUp() {
                this.pageTotal = this.showData.length
                for (let i = 0; i < this.pageTotal / this.pageSize; i++) {
                    this.pageShow[i] = this.showData.slice(this.pageSize * i, this.pageSize * (i + 1))
                }
            },
            editData() {
                this.baseInfo.num = 0
                this.baseInfo.total = 0
                this.baseInfo.profit = 0
                this.showData.forEach((el, index) => {
                    if (el.shopcar_status < 8) {
                        this.baseInfo.num = this.baseInfo.num + el.goods_num
                        this.baseInfo.total = (this.baseInfo.total - (-el.price)).toFixed(2)
                        this.baseInfo.profit = (this.baseInfo.profit - (-el.profit)).toFixed(2)
                    }
                });
            },
            filterData(date) {
                this.showData = []
                this.pageShow = []
                this.conInfo.forEach(el => {
                    let orders_date = el.receive_time.split(" ")[0]
                    if (date == orders_date) {
                        this.showData.push(el)
                    }
                });
                this.editData()
                this.pageUp()
            }
        }
    };
</script>


<style>
    #adminStatistics {
        width: 100%;
        height: 100%;
    }

    #adminStatistics>.as-header {
        width: 100%;
        height: 60px;
        background: #eee;
        font-size: 26px;
        font-weight: 600;
        line-height: 60px;
        text-indent: 60px;
        color: #555;
    }

    #adminStatistics>.as-select {
        position: relative;
        width: 100%;
        height: 120px;
        padding: 20px 0;
        border-bottom: 1px solid #ccc;
    }

    #adminStatistics .block {
        margin-left: 80px;
    }

    #adminStatistics .block>button {
        width: 80px;
        height: 30px;
        font-size: 16px;
        margin-left: 5px;
    }

    #adminStatistics>.as-content {
        width: 100%;
        height: 480px;
        border: 1px solid #333;
        margin-top: 20px;
    }

    .el-picker-panel {
        height: auto;
    }

    .baseInfo {
        width: 100%;
        height: 30px;
        margin-top: 20px;
    }

    .baseInfo>span {
        font-size: 17px;
        margin-left: 10px;
        color: #333;
    }

    .baseInfo>span:nth-of-type(1) {
        font-size: 18px;
        color: #000;
        margin-left: 100px;
    }

    .as-table {
        width: 100%;
        height: 480px;
        margin-top: 10px;
    }

    .as-table>table {
        width: 90%;
        margin: 0 auto;
    }

    .as-table tr {
        height: 30px;
        text-align: center;
    }

    .as-operate {
        width: 60px;
        font-size: 14px;
    }

    .as-page {
        float: right;
        margin-top: 10px;
        margin-right: 50px;
    }
</style>