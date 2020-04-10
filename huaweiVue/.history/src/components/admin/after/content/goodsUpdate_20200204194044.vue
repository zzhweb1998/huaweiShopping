<template>
    <div id="goodsUpdate">
        <div class="ac-header">
            商品信息修改
            <button @click="returnLast">返回</button>
        </div>
        <div class="ac-register">
            <div class="register-content">
                <p>修改商品信息</p>
                <div>
                    商品名称：
                    <input type="text" v-model="goodsName">
                </div>
                <div>
                    商品标题：
                    <textarea cols="28" rows="3" v-model="goodsTitle"></textarea>
                </div>
                <div>
                    商品类别：
                    <el-select v-model="goodsCategory" placeholder="请选择">
                        <el-option v-for="item in options" :key="item.value" :label="item.label" :value="item.value">
                        </el-option>
                    </el-select>
                </div>
                <div>
                    商品状态：
                    <el-select v-model="goodsStatus" placeholder="请选择">
                        <el-option v-for="item in status" :key="item.value" :label="item.label" :value="item.value">
                        </el-option>
                    </el-select>
                </div>
                <div>
                    <input type="button" value="修改" class="register-button" @click="register">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                goodsId: '',
                goodsName: '',
                goodsTitle: '',
                goodsCategory: '',
                goodsStatus: '',
                options: [
                    {
                        value: 'Mate',
                        label: 'Mate'
                    },
                    {
                        value: 'P',
                        label: 'P'
                    },
                    {
                        value: 'nova',
                        label: 'nova'
                    },
                    {
                        value: '畅享',
                        label: '畅享'
                    }
                ],
                status: [
                    {
                        value: '1',
                        label: '上架'
                    },
                    {
                        value: '0',
                        label: '下架'
                    },
                ]
            }
        },
        created(){
            this.goodsId = this.$route.query.goodsid
            this.axios.post("/api/shop/goodsInfo").then(res => {
                res.data.filter(item => {
                    if(item.goods_info_id == this.goodsId){
                        this.goodsName = item.goods_info_name
                        this.goodsTitle = item.goods_info_title
                        this.goodsCategory = item.goods_category
                        if(item.goods_info_status == 0){
                            this.goodsStatus = '下架'
                        }else{
                            this.goodsStatus = '上架'
                        }
                    }
                })
            })
        },
        methods: {
            returnLast() {
                this.$router.go(-1)
            },
            register() {
                if (this.goodsName.trim() == '' || this.goodsName.trim() == null) {
                    alert("请输入商品名称")
                } else if (this.goodsTitle.trim() == '' || this.goodsTitle.trim() == null) {
                    alert("请输入商品标题")
                } else if (this.goodsCategory.trim() == '' || this.goodsCategory.trim() == null) {
                    alert("请输入商品类别")
                } else {
                    this.axios.post("/api/shop/goodsUpd", {
                        id: this.goodsId,
                        name: this.goodsName,
                        title: this.goodsTitle,
                        category: this.goodsCategory,
                        status: this.goodsStatus
                    }).then(body => {
                        if (body.data == 1) {
                            alert("商品修改成功")
                            this.goodsName = ''
                            this.goodsTitle = ''
                            this.goodsCategory = ''
                            this.goodsStatus = ''
                            this.$router.go(-1)
                        }else {
                            alert("商品修改失败")
                        }
                    });
                }
            },
        }
    }
</script>

<style>
    #goodsUpdate {
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

    .ac-register {
        width: 500px;
        height: 500px;
        margin-top: 20px;
        margin-left: 100px;
        border: 1px solid #333;
    }

    .register-content {
        width: 450px;
        height: 400px;
        background-color: #f5f5f5;
        margin-top: 20px;
    }

    .register-content>p {
        font-size: 24px;
        text-align: center;
        line-height: 50px;
    }

    .register-content>div {
        width: 400px;
        height: 50px;
        font-size: 20px;
        line-height: 50px;
        margin: 20px auto;
    }

    .register-content input[type=text] {
        width: 220px;
        height: 30px;
    }

    textarea {
        vertical-align: middle;
    }

    .register-button {
        width: 80px;
        height: 35px;
        margin-left: 240px;
    }

    .el-select-dropdown {
        height: auto !important;
    }

    .register-content>div .el-input__inner {
        width: 100px;
        height: 40px;
    }
</style>