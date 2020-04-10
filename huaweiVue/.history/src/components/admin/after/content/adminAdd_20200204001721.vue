<template>
    <div id="adminAdd">
        <div class="ac-header">
            管理员添加
            <button @click="returnLast">返回</button>
        </div>
        <div class="ac-register">
            <div class="register-content">
                <p>用户注册</p>
                <div>
                    账户：
                    <input type="text" name="" id="" v-model="registerAccount">
                </div>
                <div>
                    密码：
                    <input type="text" name="" id="" v-model="registerPassword">
                </div>
                <div>
                    邮箱：
                    <input type="text" name="" id="" v-model="registerEmail">
                </div>
                <div>
                    <input type="button" value="注册" class="register-button" @click="register">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                registerAccount: '',
                registerPassword: '',
                registerEmail: '',
            }
        },
        methods:{
            returnLast(){
                this.registerAccount = ''
                this.registerPassword = ''
                this.registerEmail = ''
                this.$router.go(-1)
            },
            register() {
                if (this.registerAccount.trim() == '' || this.registerAccount.trim() == null) {
                    alert("请输入账号")
                } else if (this.registerPassword.trim() == '' || this.registerPassword.trim() == null) {
                    alert("请输入密码")
                } else if (this.registerEmail.trim() == '' || this.registerEmail.trim() == null) {
                    alert("请输入邮箱")
                } else {
                    var reg = /^\w+@[a-z0-9]+\.[a-z]+$/i;
                    if (!reg.test(this.registerEmail.trim())) {
                        alert('请输入有效的邮箱')
                    } else {
                        this.axios.post("/api/shop/register", {
                            account: this.registerAccount,
                            password: this.registerPassword,
                            email: this.registerEmail,
                            registerIf: 0
                        }).then(body => {
                            if (body.data == 1) {
                                alert("用户已存在")
                            } else if (body.data == 2) {
                                alert("此邮箱已被注册")
                            } else {
                                alert("注册成功")
                                this.registerAccount = ''
                                this.registerPassword = ''
                                this.registerEmail = ''
                                this.registerShow = false
                            }
                        });
                    }
                }
            },
        }
    }
</script>

<style>
    #adminAdd{
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
    .ac-header>button{
        float: right;
        width: 80px;
        height: 40px;
        font-size: 18px;
        color: #333;
        margin-top: 10px;
        margin-right: 150px;
    }
    .ac-register{
        width: 800px;
        height: 500px;
        margin-top: 20px;
        margin-left: 100px;
        border: 1px solid #333;
    }
    .register-content {
        width: 400px;
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
        width: 300px;
        height: 50px;
        font-size: 20px;
        line-height: 50px;
        margin: 20px auto;
    }

    .register-content input[type=text] {
        width: 220px;
        height: 30px;
    }

    .register-button {
        width: 70px;
        height: 30px;
        margin-left: 140px;
        cursor: pointer;
        border: none;
    }
</style>