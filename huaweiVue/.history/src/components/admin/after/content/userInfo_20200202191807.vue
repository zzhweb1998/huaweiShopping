<template>
    <div id="userInfo">
        <div class="ac-header">
            用户信息
        </div>
        <div class="ac-search">
            <span>用户账号：</span>
            <input type="text">
            <button>查询</button>
        </div> 
        <div class="ac-table">
            <table border="1" cellspacing="0" cellpadding="0">
                <tr>
                    <th>账号</th>
                    <th>密码</th>
                    <th>邮箱</th>
                    <th>余额</th>
                    <th>会员等级</th>
                    <th>操作</th>
                </tr>
                <tr v-for="(sd,index) in showData" :key="index">
                    <td>{{sd.user_account}}</td>
                    <td>{{sd.user_password}}</td>
                    <td>{{sd.user_email}}</td>
                    <td>{{sd.user_moeny}}</td>
                    <td>{{sd.user_Grade}}</td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                userInfo: '',
                showData: ''
            }
        },
        created(){
            this.axios.post("/api/shop/user",{
                gradeIf: 0
            }).then(res => {
                this.userInfo = res.data
                this.showData = this.userInfo
            })
        }
    }
</script>


<style>
    #userInfo{
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
        text-indent: 60px;
        color: #555;
    }
    .ac-search{
        width: 100%;
        height: 60px;
        font-size: 20px;
        line-height: 60px;
        text-indent: 150px;
        border-bottom: 1px solid #ccc;
    }
    .ac-search>input[type=text]{
        width: 200px;
        height: 30px;
        font-size: 20px;
        text-indent: 5px;
        outline: none;
    }
    .ac-search>button{
        width: 80px;
        height: 30px;
        margin-left: 10px;
        font-size: 16px;
    }
    .ac-table{
        width: 100%;
        height: 510px;
        margin-top: 10px;
    }
    .ac-table>table{
        width: 90%;
        margin: 0 auto;
    }
    .ac-table tr{
        height: 30px;
        text-align: center;
    }
</style>