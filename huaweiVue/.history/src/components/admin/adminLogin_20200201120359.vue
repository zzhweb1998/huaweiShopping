<template>
    <div class="userLogin">
        <div class="userLogin-box">
            <a href="javascript:;">华为手机商城管理员登陆界面</a>
            <div class="userLogin-content">
                <div>
                    账号：
                    <input type="text" name="user-account" placeholder="请输入账号" v-model="loginAccount"
                        class="login-text">
                </div>
                <div>
                    密码：
                    <input type="text" name="user-password" placeholder="请输入密码" v-model="loginPassword"
                        class="login-text">
                </div>
                <div>
                    验证码：
                    <identify @ifcode="ifcode" ref="clear" />
                </div>
                <div>
                    <input type="button" value="登陆" class="login-button" @click="login">
                </div>
            </div>
        </div>
        <div class="login-bgimage"></div>
    </div>
</template>

<script>
    import identify from '../../components/identify.vue'
    export default {
        data() {
            return {
                loginAccount: '',
                loginPassword: '',
                checkCode: '',
                picLyanzhengma: '',
                registerAccount: '',
                registerPassword: '',
                registerEmail: '',
                registerShow: false
            }
        },
        components: {
            identify
        },
        methods: {
            login() {
                if (this.loginAccount.trim() == '' || this.loginAccount.trim() == null) {
                    alert("请输入账号")
                    this.$refs.clear.clear()
                } else if (this.loginPassword.trim() == '' || this.loginPassword.trim() == null) {
                    alert("请输入密码")
                    this.$refs.clear.clear()
                } else if (this.picLyanzhengma.trim() == '' || this.picLyanzhengma.trim() == null) {
                    alert("请输入验证码")
                } else if (this.picLyanzhengma.trim().toUpperCase() != this.checkCode.trim().toUpperCase()) {
                    alert("验证码错误")
                } else {
                    this.axios.post("", {
                        account: this.loginAccount,
                        password: this.loginPassword,
                        loginIf: 0
                    }).then(body => {
                        if (body.data == 0) {
                            alert("输入的账号有误，请重新输入")
                            this.loginAccount = ''
                            this.loginPassword = ''
                            this.$refs.clear.clear()
                        } else if (body.data == 2) {
                            alert("输入的密码有误，请重新输入")
                            this.loginPassword = ''
                            this.$refs.clear.clear()
                        } else if (body.data == 1) {
                            let account = this.loginAccount.trim()
                            sessionStorage.setItem('account', account)
                            let password = this.loginPassword.trim()
                            sessionStorage.setItem('password', password)
                            this.loginAccount = ''
                            this.loginPassword = ''
                            this.$router.push('/user')
                        }
                    });
                }
            },
            ifcode(data) {
                this.checkCode = data.checkCode
                this.picLyanzhengma = data.picLyanzhengma
            },
        }
    }
</script>

<style>
    body>div{
        width: 100%;
        height: 100%;
    }
    .userLogin {
        width: 100%;
        height: 100%;
        position: relative;
    }

    .login-bgimage {
        position: absolute;
        top: 60px;
        left: 260px;
        width: 540px;
        height: 405px;
        z-index: -1;
        background: url("https://ss3.bdstatic.com/70cFv8Sh_Q1YnxGkpoWK1HF6hhy/it/u=2901635308,878466965&fm=26&gp=0.jpg");
        background-repeat: no-repeat;
        background-size: contain;
    }

    .userLogin-box {
        width: 900px;
        height: 600px;
        margin: 0 auto;
    }

    .userLogin-box>a {
        position: absolute;
        top: 130px;
        left: 820px;
        color: #333;
        font-size: 30px;
    }

    .userLogin-content {
        float: right;
        width: 400px;
        height: 210px;
        margin-top: 200px;
        background-color: rgba(255, 255, 255, 0.3);
    }

    .userLogin-content>div {
        width: 100%;
        height: 50px;
        font-size: 18px;
        line-height: 50px;
    }

    .login-text {
        width: 290px;
        height: 30px;
        font-size: 18px;
        margin-left: 17px;
    }

    .login-button {
        width: 80px;
        height: 30px;
        margin-left: 280px;
        cursor: pointer;
        border: none;
    }

    .login-button:nth-of-type(2) {
        margin-left: 3px;
    }

</style>