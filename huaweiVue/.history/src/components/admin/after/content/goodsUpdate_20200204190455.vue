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
                    <input type="button" value="添加" class="register-button" @click="register">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
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
                        value: '0',
                        label: '上架'
                    },
                    {
                        value: '1',
                        label: '下架'
                    },
                ]
            }
        },
        methods: {
            returnLast() {
                this.$router.go(-1)
            },
            register() {
                console.log(this.goodsStatus);
                
                // if (this.registerAccount.trim() == '' || this.registerAccount.trim() == null) {
                //     alert("请输入账号")
                // } else if (this.registerPassword.trim() == '' || this.registerPassword.trim() == null) {
                //     alert("请输入密码")
                // } else if (this.registerEmail.trim() == '' || this.registerEmail.trim() == null) {
                //     alert("请输入邮箱")
                // } else {
                //     var reg = /^\w+@[a-z0-9]+\.[a-z]+$/i;
                //     if (!reg.test(this.registerEmail.trim())) {
                //         alert('请输入有效的邮箱')
                //     } else {
                //         this.axios.post("/api/shop/register", {
                //             account: this.registerAccount,
                //             password: this.registerPassword,
                //             email: this.registerEmail,
                //             registerIf: 1
                //         }).then(body => {
                //             if (body.data == 1) {
                //                 alert("用户已存在")
                //             } else if (body.data == 2) {
                //                 alert("此邮箱已被注册")
                //             } else {
                //                 alert("注册成功")
                //             }
                //         });
                //     }
                // }
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