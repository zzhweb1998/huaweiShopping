<template>
    <div id="goodsStock">
        <div class="ac-header">
            商品库存
        </div>
        <div class="ac-search">
            <span>商品编号：</span>
            <input type="text" v-model="keyword">
            <button @click="search">查询</button>
        </div>
        <div class="ac-table">
            <table border="1" cellspacing="0" cellpadding="0">
                <tr>
                    <th>商品编号</th>
                    <th>商品名称</th>
                    <th>商品颜色</th>
                    <th>商品配置</th>
                    <th>库存数量</th>
                    <th>进货总数</th>
                    <th>进货总额</th>
                    <th>商品状态</th>
                    <th>操作</th>
                </tr>
                <tr v-for="(ps,index) in pageShow[pageCurrent]" :key="index">
                    <td>{{ps.goods_no}}</td>
                    <td>{{ps.goods_info_name}}</td>
                    <td>{{ps.goods_color}}</td>
                    <td>{{ps.goods_configure}}</td>
                    <td>{{ps.stock_num}}</td>
                    <td>{{ps.purchase_sum}}</td>
                    <td>{{ps.purchase_total}}</td>
                    <td>{{ps.goods_status}}</td>
                    <td>
                        <button class="ac-operate">进货</button>
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
            this.axios.post("/api/shop/goodsDetailed").then(res => {
                this.conInfo = res.data.reverse()
                this.showData = this.conInfo
                this.pageTotal = this.showData.length
                for (let i = 0; i < this.pageTotal / this.pageSize; i++) {
                    this.pageShow[i] = this.showData.slice(this.pageSize * i, this.pageSize * (i + 1))
                }
            })
        },
        methods: {
            search() {
                if (this.keyword == '' || this.keyword == null) {
                    this.showData = this.conInfo
                    this.pageUp()
                } else {
                    this.showData = this.conInfo.filter(item => {
                        if (item.goods_no.toUpperCase().includes(this.keyword.trim().toUpperCase())) {
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
            purchasePage(no) {
                this.$router.push({ path: '/admin/goodsPurchase', query: { goodsno: no } })
            },
        }
    }
</script>

<style>
    #goodsStock {
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