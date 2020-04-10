<template>
    <div id="goodsInfo">
        <div class="ac-header">
            商品信息
        </div>
        <div class="ac-search">
            <span>商品名称：</span>
            <input type="text" v-model="keyword">
            <button @click="search">查询</button>
            <button @click="addPage">添加</button>
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
                    <td>{{ps.goods_info_status}}</td>
                    <td>
                        <button class="ac-operate" @click="updatePage">修改</button>
                        <button class="ac-operate" @click="detele">删除</button>
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
            pageShow: [] //当前页显示数据
        }
    },
    created() {
        this.axios.post("/api/shop/goodsInfo").then(res => {
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
            this.$router.push('/admin/goodsAdd')
        },
        updatePage(){
            this.$router.push('/admin/goodsUpdate')
        },
        detele(){
            let delIf = confirm('是否要删除此用户')
            
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
    #goodsInfo{
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