<template>
    <div id="goodsDetailed">
        <div class="ac-header">
            商品详情
            <button @click="returnLast">返回</button>
        </div>
        <div class="ac-modify">
            <div class="modify-info">
                <div>
                    商品编号：
                    <input type="text" v-model="goodsNo">
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    商品颜色：
                    <input type="text" v-model="goodsColor">
                </div>
                <div>
                    商品配置：
                    <el-select v-model="goodsConfigure" placeholder="请选择">
                        <el-option v-for="item in configure" :key="item.value" :label="item.label" :value="item.value">
                        </el-option>
                    </el-select>
                    &nbsp;&nbsp;&nbsp;&nbsp;
                    商品价格：
                    <input type="number" min="0" step="0.01" @change="priceIf" v-model="goodsPrice">
                </div>
                <div>
                    商品状态：
                    <el-select v-model="goodsConfigure" placeholder="请选择">
                        <el-option v-for="item in configure" :key="item.value" :label="item.label" :value="item.value">
                        </el-option>
                    </el-select>
                </div>
            </div>
            <div class="modify-operate">
                <button @click="goodsAdd">添加</button>
                <br>
                <button @click="goodsUpd">修改</button>
            </div>
        </div>
        <div class="ac-table">
            <table border="1" cellspacing="0" cellpadding="0">
                <tr>
                    <th>商品编号</th>
                    <th>商品颜色</th>
                    <th>商品配置</th>
                    <th>商品价格</th>
                    <th>商品状态</th>
                    <th>操作</th>
                </tr>
                <tr v-for="(ps,index) in pageShow[pageCurrent]" :key="index">
                    <td>{{ps.goods_no}}</td>
                    <td>{{ps.goods_color}}</td>
                    <td>{{ps.goods_configure}}</td>
                    <td>{{ps.goods_price}}</td>
                    <td>
                        <p v-for="(gs,index) in goodsStatus" :key="index" v-show="gs.no == ps.goods_status">
                            {{gs.status}}</p>
                    </td>
                    <td>
                        <button class="ac-operate" @click="updateInfo(ps.goods_no)">修改</button>
                        <button class="ac-operate" @click="purchasePage(ps.goods_no)">进货</button>
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
                goodsName:'', 
                goodsId:'',
                conInfo: '',  //内容数据
                showData: '', //需要的内容数据
                keyword: '', //关键字
                pageTotal: 0, //总数据量
                pageCurrent: 0, //当前页数
                pageSize: 8,  //每页显示数量
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
                    {
                        no: 2,
                        status: '删除'
                    },
                    {
                        no: 3,
                        status: '特价'
                    },
                    {
                        no: 4,
                        status: '热销'
                    },
                ],
                configure: [
                    {
                        value: '(全网通)3GB+32GB',
                        label: '(全网通)3GB+32GB'
                    },
                    {
                        value: '(全网通)3GB+64GB',
                        label: '(全网通)3GB+64GB'
                    },
                    {
                        value: '(全网通)4GB+32GB',
                        label: '(全网通)4GB+32GB'
                    },
                    {
                        value: '(全网通)4GB+64GB',
                        label: '(全网通)4GB+64GB'
                    },
                    {
                        value: '(全网通)4GB+128GB',
                        label: '(全网通)4GB+128GB'
                    },
                    {
                        value: '(全网通)6GB+128GB',
                        label: '(全网通)6GB+128GB'
                    },
                    {
                        value: '(全网通)8GB+128GB',
                        label: '(全网通)8GB+128GB'
                    },
                    {
                        value: '(全网通)8GB+256GB',
                        label: '(全网通)8GB+256GB'
                    },
                    {
                        value: '(全网通)8GB+512GB',
                        label: '(全网通)8GB+512GB'
                    }
                ],
                goodsNo: '',
                goodsColor: '',
                goodsConfigure: '',
                goodsPrice: 0,
            
            }
        },
        created() {
            this.goodsId = this.$route.query.goodsid
            console.log(this.goodsId);
            
            this.axios.post("/api/shop/selectGD",{
                id: this.goodsId
            }).then(res => {
                console.log(res.data);
                this.conInfo = res.data
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
            purchasePage(no) {
                this.$router.push({ path: '/admin/goodsPurchase', query: { goodsno: no } })
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
            },
            priceIf(){
                let priceReg = /(^[1-9]\d*(\.\d{1,2})?$)|(^0(\.\d{1,2})?$)/
                if(!priceReg.test(this.goodsPrice)){
                    this.goodsPrice = 0
                }
            },
            updateInfo(no){
                this.conInfo.filter(item => {
                    if(item.goods_no == no){
                        this.goodsNo = item.goods_no
                        this.goodsColor = item.goods_color
                        this.goodsConfigure = item.goods_configure
                        this.goodsPrice = item.goods_price
                    }
                })
            },
            goodsAdd(){
                if(this.goodsNo.trim() == '' || this.goodsNo.trim() == null){
                    alert('请输入商品编号')
                }else if(this.goodsColor.trim() == '' || this.goodsColor.trim() == null){
                    lert('请输入商品颜色')
                }else if(this.goodsConfigure.trim() == '' || this.goodsConfigure.trim() == null){
                    lert('请选择商品配置')
                }else if(this.goodsPrice.trim() == '' || this.goodsPrice.trim() == null){
                    lert('请输入商品价格')
                }else{
                    this.axios.post("/api/shop/addGD",{
                        id: this.goodsId,
                        no: this.goodsNo,
                        color: this.goodsColor,
                        configure: this.goodsConfigure,
                        price: this.goodsPrice 
                    }).then(res => {
                        if(res.data == 1){
                            alert('商品添加成功')
                        }else if(res.data == 2){
                            alert('商品编号已存在')
                        }else{
                            alert('商品添加失败')
                        }
                    })
                }
            },
            goodsUpd(){

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

    .modify-info {
        float: left;
        width: 660px;
        height: 100%;
        font-size: 20px;
        margin-left: 65px;
    }

    .modify-info>div {
        margin-top: 20px;
    }

    .modify-info>div input[type=text],input[type=number] {
        width: 200px;
        height: 40px;
        font-size: 15px;
        vertical-align: middle;
        text-indent: 10px;
    }
    .modify-operate{
        float: left;
        width: 122px;
        height: 120px;
        margin-left: 20px;
        margin-top: 10px;
        border-left: 1px solid #ccc;
    }
    .modify-operate>button{
        width: 120px;
        height: 40px;
        font-size: 18px;
        margin-left: 10px;
        margin-top: 10px;
    }
    .ac-modify {
        width: 100%;
        height: 200px;
        border: 1px solid #ccc;
    }

    .ac-table {
        width: 100%;
        height: 380px;
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

    .el-select-dropdown {
        height: auto !important;
    }

    .register-content>div .el-input__inner {
        width: 100px;
        height: 40px;
    }

</style>