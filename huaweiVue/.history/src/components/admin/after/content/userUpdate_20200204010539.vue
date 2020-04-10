<template>
    <div id="userUpdate">
        <div class="ac-header">
            用户信息修改
        </div>
        <div class="ac-update">
            <div class="update-content">
                <p>{{account}}管理员基本信息</p>
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
</style>