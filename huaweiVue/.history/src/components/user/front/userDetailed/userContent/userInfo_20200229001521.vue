<template>
    <div id="userInfo">
        <div class="userName">
            {{userAccount}}的基本信息
        </div>
        <div class="userDetailed">
            <p>
                <span>用户邮箱：{{userInfo.user_email}}</span>
            </p>
            <p>
                <span>用户余额：{{userInfo.user_money}}</span>
                <button @click="selPage(1)">冲值</button>
            </p>
            <p>
                <span>用户等级：{{userInfo.user_Grade}}</span>
            </p>
            <button @click="selPage(2)">修改登陆密码</button>
            <button v-if="payIf == 1" @click="selPage(3)">修改支付密码</button>
            <button v-if="payIf == 0" @click="selPage(3)">设置支付密码</button>
        </div>
        <div class="userOperate">
            <div class="amPage" v-show="amShow == 1">
                <p>余额冲值</p>
                <p>
                    <span>金额：</span>
                    <input type="number" min="0" step="0.01" v-model="addMoney" @change="priceIf">
                </p>
                <button @click="amOperate">冲值</button>
            </div>
            <div class="pwPage" v-show="pwShow == 1">
                <p>修改登陆密码</p>
                <p>
                    <span>请输入旧密码：</span>
                    <input type="password" min="0" step="0.01" v-model="oldPW">
                </p>
                <p>
                    <span>请输入新密码：</span>
                    <input type="password" min="0" step="0.01" v-model="newPW">
                </p>
                <p>
                    <span>再确认新密码：</span>
                    <input type="password" min="0" step="0.01" v-model="repeatPW">
                </p>
                <button @click="pwOperate">修改</button>
            </div>
            <div class="payPage" v-show="payShow == 1 && payIf == 1">
                <p>修改支付密码</p>
                <p>
                    <span>请输入旧密码：</span>
                    <input type="password" min="0" step="0.01" v-model="oldPW">
                </p>
                <p>
                    <span>请输入新密码：</span>
                    <input type="password" min="0" step="0.01" v-model="newPW">
                </p>
                <p>
                    <span>再确认新密码：</span>
                    <input type="password" min="0" step="0.01" v-model="repeatPW">
                </p>
                <button @click="payOperate">修改</button>
            </div>
            <div class="payPage" v-show="payShow == 1 && payIf == 0">
                <p>设置支付密码</p>
                <p>
                    <span>请输入支付密码：</span>
                    <input type="password" min="0" step="0.01" v-model="newPW">
                </p>
                <p>
                    <span>再确认支付密码：</span>
                    <input type="password" min="0" step="0.01" v-model="repeatPW">
                </p>
                <button @click="payOperate">修改</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                userAccount: '',
                userInfo: '',
                pwShow: 0,
                payShow: 0,
                amShow: 0,
                payIf: 0,
                addMoney: 0,
                newPW: '',
                oldPW: '',
                repeatPW: ''
            }
        },
        created() {
            this.userAccount = sessionStorage.getItem('account')
            this.axios.post("/api/shop/userInfo", {
                account: this.userAccount
            }).then(res => {
                this.userInfo = res.data[0]
                if (this.userInfo.user_pay == null || this.userInfo.user_pay == '') {
                    this.payIf = 0
                }else{
                    this.payIf = 1
                }
            })

        },
        methods: {
            selPage(index) {
                if (index == 1) {
                    this.amShow = 1
                    this.payShow = 0
                    this.pwShow = 0
                } else if (index == 2) {
                    this.amShow = 0
                    this.payShow = 0
                    this.pwShow = 1
                } else if (index == 3) {
                    this.amShow = 0
                    this.payShow = 1
                    this.pwShow = 0
                }
            },
            amOperate() {
                let amIf = confirm('是否冲值')
                if (amIf == true) {
                    if (this.addMoney == 0) {
                        alert('请输入冲值额度')
                    } else {
                        this.axios.post("/api/shop/addMoney", {
                            account: this.userAccount,
                            money: this.addMoney
                        }).then(res => {
                            if (res.data != []) {
                                alert('冲值成功')
                                this.userInfo = res.data[0]
                            } else {
                                alert('冲值失败')
                            }
                            this.amShow = 0
                            this.addMoney = 0
                        })
                    }
                }
            },
            pwOperate() {
                if (this.oldPW == '' || this.oldPW == '') {
                    alert('请输入旧密码')
                } else if (this.oldPW != this.userInfo.user_password) {
                    alert('输入的旧密码有误')
                } else if (this.newPW == '' || this.newPW == '') {
                    alert('请输入新密码')
                } else if (this.newPW.length > 5 && this.newPW.length > 12) {
                    alert('请输入6~11位的新密码')
                } else if (this.repeatPW == '' || this.repeatPW == '') {
                    alert('请输入重复框新密码')
                } else if (this.newPW != this.repeatPW) {
                    alert('两次输入的密码不一致')
                } else {
                    let pwIf = confirm('是否修改登陆密码')
                    if (pwIf == true) {
                        this.axios.post("/api/shop/updatePW", {
                            account: this.userAccount,
                            newpw: this.newPW
                        }).then(res => {
                            if (res.data == 1) {
                                alert("登陆密码修改成功")
                            } else {
                                alert("登陆密码修改失败")
                            }
                            this.pwShow = 0
                            this.oldPW = ''
                            this.newPW = ''
                            this.repeatPW = ''
                        })
                    }
                }
            },
            payOperate() {
                if (this.payIf == 1) {
                    if (this.oldPW == '' || this.oldPW == '') {
                        alert('请输入旧密码')
                    } else if (this.oldPW != this.userInfo.user_password) {
                        alert('输入的旧密码有误')
                    } else if (this.newPW == '' || this.newPW == '') {
                        alert('请输入新密码')
                    } else if (this.newPW.length > 5 && this.newPW.length > 12) {
                        alert('请输入6~11位的新密码')
                    } else if (this.repeatPW == '' || this.repeatPW == '') {
                        alert('请输入重复框新密码')
                    } else if (this.newPW != this.repeatPW) {
                        alert('两次输入的密码不一致')
                    } else {
                        let payIf = confirm('是否修改支付密码')
                        if (payIf == true) {
                            this.axios.post("/api/shop/updatePay", {
                                account: this.userAccount,
                                newpw: this.newPW
                            }).then(res => {
                                if (res.data == 1) {
                                    alert("支付密码修改成功")
                                } else {
                                    alert("支付密码修改失败")
                                }
                                this.payShow = 0
                                this.oldPW = ''
                                this.newPW = ''
                                this.repeatPW = ''
                            })
                        }
                    }

                } else {
                     if (this.newPW == '' || this.newPW == '') {
                        alert('请输入新密码')
                    } else if (this.newPW.length > 5 && this.newPW.length > 12) {
                        alert('请输入6~11位的新密码')
                    } else if (this.repeatPW == '' || this.repeatPW == '') {
                        alert('请输入重复框新密码')
                    } else if (this.newPW != this.repeatPW) {
                        alert('两次输入的密码不一致')
                    } else {
                        let payIf = confirm('是否设置为支付密码')
                        if (payIf == true) {
                            this.axios.post("/api/shop/updatePay", {
                                account: this.userAccount,
                                newpw: this.newPW
                            }).then(res => {
                                if (res.data == 1) {
                                    alert("支付密码修改成功")
                                } else {
                                    alert("支付密码修改失败")
                                }
                                this.payShow = 0
                                this.payIf = 1
                                this.oldPW = ''
                                this.newPW = ''
                                this.repeatPW = ''
                            })
                        }
                    }

                }
            },
            priceIf() {
                let moneyReg = /(^[1-9]\d*(\.\d{1,2})?$)|(^0(\.\d{1,2})?$)/
                if (!moneyReg.test(this.addMoney)) {
                    this.addMoney = 0
                }
            },

        }
    }
</script>

<style>
    #userInfo {
        width: 100%;
        height: 100%;
    }

    .userName {
        width: 100%;
        height: 10%;
        line-height: 50px;
        font-size: 22px;
        text-indent: 30px;
        background: #eee;
    }

    .userDetailed {
        float: left;
        width: 400px;
        height: 90%;
    }

    .userDetailed>p {
        margin-top: 10px;
        margin-left: 30px;
    }

    .userDetailed>button {
        width: 120px;
        height: 40px;
        font-size: 16px;
        margin-top: 20px;
        margin-left: 10px;
    }

    .userDetailed>button:nth-of-type(1) {
        margin-left: 30px;
    }

    .userDetailed>p>span {
        font-size: 18px;
        color: #333;
    }

    .userDetailed>p>button {
        width: 80px;
        height: 25px;
        font-size: 16px;
        margin-left: 10px;
    }

    .userOperate {
        float: left;
        width: 400px;
        height: 50%;
    }

    .userOperate>div {
        width: 100%;
        height: 100%;
        border: 1px solid #f9f9f9;
    }

    .userOperate>div>p:nth-of-type(1) {
        width: 100%;
        height: 40px;
        line-height: 40px;
        font-size: 18px;
        background: #f9f9f9;
    }

    .amPage span {
        font-size: 16px;
        color: #333;
    }

    .amPage input[type=number] {
        width: 120px;
        height: 30px;
    }

    .amPage>button {
        width: 80px;
        height: 30px;
        margin-top: 10px;
        margin-left: 90px;
    }

    .pwPage>p:nth-of-type(n+2),
    .payPage>p:nth-of-type(n+2) {
        margin-top: 10px;
        font-size: 16px;
    }

    .pwPage input[type=password],
    .payPage input[type=password] {
        width: 150px;
        height: 30px;
        font-size: 20px;
    }

    .pwPage>button {
        width: 80px;
        height: 30px;
        margin-top: 10px;
        margin-left: 185px;
    }

    .payPage>button {
        width: 80px;
        height: 25px;
        margin-top: 10px;
        margin-left: 205px;
    }
</style>