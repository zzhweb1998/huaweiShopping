<template>
    <div id="userUpdate">
        <div class="ac-header">
            用户信息修改
            <button @click="returnLast">返回</button>
        </div>
        <div class="ac-update">
            <div class="update-content">
                <p>{{account}}用户基本信息</p>
                <div>
                    密码：
                    <input type="text" name="" id="" v-model="updatePassword">
                </div>
                <div>
                    邮箱：
                    <input type="text" name="" id="" v-model="updateEmail">
                </div>
                <div>
                    <input type="button" value="修改" class="update-button" @click="update">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                info:'',
                account: '',
                updatePassword: '',
                updateEmail: '',
            }
        },
        created() {
            this.account = this.$route.query.account
            this.axios.post("/api/shop/user", {
                gradeIf: 0
            }).then(res => {
                this.info = res.data
                this.info.filter(item => {
                    if (item.user_account == this.account) {
                        this.updatePassword = item.user_password
                        this.updateEmail = item.user_email
                    }
                })
            })
        },
        methods: {
            returnLast() {
                this.$router.go(-1)
            },
            update() {
                if (this.updatePassword.trim() == '' || this.updatePassword.trim() == null) {
                    alert("请输入密码")
                } else if (this.updateEmail.trim() == '' || this.updateEmail.trim() == null) {
                    alert("请输入邮箱")
                } else {
                    var reg = /^\w+@[a-z0-9]+\.[a-z]+$/i;
                    if (!reg.test(this.updateEmail.trim())) {
                        alert('请输入有效的邮箱')
                    } else {
                        this.axios.post("/api/shop/updateUser", {
                            account: this.account,
                            password: this.updatePassword,
                            email: this.updateEmail,
                            updateIf: 0
                        }).then(body => {
                            if (body.data == 1) {
                                alert("修改成功")
                                this.userInfo()
                            } else if (body.data == 2) {
                                alert("此邮箱已被注册")
                            }else{
                                alert("修改失败")
                            }
                        });
                    }
                }
            },
            userInfo() {
                this.axios.post("/api/shop/user", {
                    gradeIf: 0
                }).then(res => {
                    res.data.filter(item => {
                        if (item.user_account == this.account) {
                            this.updatePassword = item.user_password
                            this.updateEmail = item.user_email
                        }
                    })
                })
            }
        }
    }
</script>

<style>
    #userUpdate{
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
    .ac-header>button {
        float: right;
        width: 80px;
        height: 40px;
        font-size: 18px;
        color: #333;
        margin-top: 10px;
        margin-right: 150px;
    }
    .ac-update{
        width: 500px;
        height: 500px;
        margin-top: 20px;
        margin-left: 100px;
        border: 1px solid #333;
    }
    .update-content {
        width: 400px;
        height: 400px;
        background-color: #f5f5f5;
        margin-top: 20px;
    }

    .update-content>p {
        font-size: 24px;
        text-align: center;
        line-height: 50px;
    }

    .update-content>div {
        width: 300px;
        height: 50px;
        font-size: 20px;
        line-height: 50px;
        margin: 20px auto;
    }

    .update-content input[type=text] {
        width: 220px;
        height: 30px;
    }

    .update-button {
        width: 80px;
        height: 40px;
        margin-left: 200px;
    }
</style>