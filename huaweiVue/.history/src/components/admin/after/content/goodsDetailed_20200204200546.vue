<template>
    <div id="goodsDetailed">
        <div class="ac-header">
            商品详情
            <button @click="returnLast">返回</button>
        </div>
        <div class="ac-operate">

        </div>
        <div class="ac-table">
            <table border="1" cellspacing="0" cellpadding="0">
                <tr>
                    <th>商品ID</th>
                    <th>商品名称</th>
                    <th>商品标题</th>
                    <th>商品类别</th>
                    <th>商品状态</th>
                    <th>操作</th>
                </tr>
                <tr v-for="(ps,index) in pageShow[pageCurrent]" :key="index">
                    <td>{{ps.goods_info_id}}</td>
                    <td>{{ps.goods_info_name}}</td>
                    <td>{{ps.goods_info_title}}</td>
                    <td>{{ps.goods_category}}</td>
                    <td>
                        <p v-for="(gs,index) in goodsStatus" :key="index" v-show="gs.no == ps.goods_info_status">
                            {{gs.status}}</p>
                    </td>
                    <td>
                        <button class="ac-operate" @click="updatePage(ps.goods_info_id)">修改</button>
                        <button class="ac-operate" @click="detailedPage(ps.goods_info_id)">详情</button>
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
                pageSize: 5,  //每页显示数量
                pageShow: [], //当前页显示数据
                goodsStatus: [
                    {
                        no: 0,
                        status: '下架'
                    },
                    {
                        no: 1,
                        status: '上架'
                    },
                ]
            }
        },
        created() {
            this.axios.post("/api/shop/goodsInfo").then(res => {
                this.conInfo = res.data.reverse()
                this.showData = this.conInfo
                this.pageTotal = this.showData.length
                for (let i = 0; i < this.pageTotal / this.pageSize; i++) {
                    this.pageShow[i] = this.showData.slice(this.pageSize * i, this.pageSize * (i + 1))
                }
            })
        },
        methods: {
            returnLast() {
                this.$router.go(-1)
            },
            addPage() {
                this.$router.push('/admin/goodsAdd')
            },
            updatePage(id) {
                this.$router.push({ path: '/admin/goodsUpdate', query: { goodsid: id } })
            },
            detailedPage(id) {
                this.$router.push({ path: '/admin/goodsDetailed', query: { goodsid: id } })
            },
            search() {
                if (this.keyword == '' || this.keyword == null) {
                    this.showData = this.conInfo
                    this.pageUp()
                } else {
                    this.showData = this.conInfo.filter(item => {
                        if (item.goods_info_name.toUpperCase().includes(this.keyword.trim().toUpperCase())) {
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
    #goodsDetailed {
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

    .ac-header>button {
        float: right;
        width: 80px;
        height: 40px;
        font-size: 18px;
        color: #333;
        margin-top: 10px;
        margin-right: 150px;
    }

    .ac-operate{
        width: 100%;
        height: 300px;
        border: 1px solid #333;
    }

    .ac-table {
        width: 100%;
        height: 410px;
        margin-top: 10px;
        border: 1px solid #333;
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