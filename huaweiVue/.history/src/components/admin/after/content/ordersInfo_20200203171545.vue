<template>
    <div id="ordersInfo">
        <div class="ac-header">
            订单信息
        </div>
        <div class="ac-search">
            <span>订单编号：</span>
            <input type="text" v-model="keyword">
            <button @click="search">查询</button>
        </div>
        <div class="ac-table">
            <table border="1" cellspacing="0" cellpadding="0">
                <tr>
                    <th>商品ID</th>
                    <th>商品名称</th>
                    <th>商品标题</th>
                    <th>商品类别</th>
                    <th>商品状态</th>
                    <th>操作</th>
                </tr>
                <tr v-for="(ps,index) in pageShow[pageCurrent]" :key="index">
                    <td>{{ps.goods_info_id}}</td>
                    <td>{{ps.goods_info_name}}</td>
                    <td>{{ps.goods_info_title}}</td>
                    <td>{{ps.goods_category}}</td>
                    <td>{{ps.goods_info_status}}</td>
                    <td>
                        <button class="ac-operate" @click="updatePage">修改</button>
                        <button class="ac-operate" @click="detele">删除</button>
                    </td>
                </tr>
            </table>
            <el-pagination background layout="prev, pager, next" :total="pageTotal" :page-size="8"
                @current-change="currentChange" class="ac-page">
            </el-pagination>
        </div>
    </div>
</template>


<style>
    #ordersInfo{
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