<template>
    <div id="userInfo">
        <div class="ac-header">
            用户信息
        </div>
        <div class="ac-search">
            <span>管理员账号：</span>
            <input type="text">
            <button>查询</button>
        </div> 
        <div class="ac-table">
            <table border="1" cellspacing="0" cellpadding="0">
                <tr>
                    <th>账号</th>
                    <th>密码</th>
                    <th>邮箱</th>
                    <th>操作</th>
                </tr>
                <tr>
                    <td>aaa</td>
                    <td>aaa</td>
                    <td>aaa</td>
                    <td>aaa</td>
                </tr>
            </table>
        </div>
    </div>
</template>


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
        text-indent: 100px;
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