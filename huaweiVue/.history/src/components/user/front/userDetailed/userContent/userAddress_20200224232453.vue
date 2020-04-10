<template>
    <div id="userAddress">
        <div class="addressTitle">收货地址管理</div>
        <div class="addressOperate">
            <div>
                <span>收货人：</span>
                <input type="text" v-model="addressName">
            </div>
            <div>
                <span>手机号码：</span>
                <input type="text" v-model="addressPhone">
            </div>
            <div>
                <span>收货地址：</span>
                <div class="ao-content">
                    <v-distpicker :placeholders="placeholders" @selected="onSelected"></v-distpicker>
                    <textarea cols="50" rows="3" placeholder="输入详细地址信息" v-model="addressDetailed"></textarea>
                </div>
            </div>
            <div v-show="operateIf == 0">
                <span>邮编：</span>
                <input type="text" v-model="addressZip">
            </div>
            <div>
                <button>添加新地址</button>
                <button>清 空</button>
            </div>
            <div v-show="operateIf == 1"> 
                <button>确 定</button>
                <button>取 消</button>
            </div>
        </div>
        <div class="addressBox">
            <div class="addressHeader">

            </div>
            <div class="addressInfo">

            </div>
        </div>
    </div>
</template>

<script>
    import VDistpicker from 'v-distpicker'

    export default {
        data() {
            return {
                placeholders: {
                    province: '省',
                    city: '市',
                    area: '区',
                },
                addressName:'',
                addressPhone:'',
                addressDetailed:'',
                addressZip:'',
                operateIf: 0,
            }
        },
        created() {

        },
        methods: {
            onSelected(data) {
                this.placeholders.province = data.province.value
                this.placeholders.city = data.city.value
                this.placeholders.area = data.area.value
                console.log(this.placeholders.province);
                console.log(this.placeholders.city);
                console.log(this.placeholders.area);
            },

        },
        components: {
            VDistpicker
        }
    }
</script>

<style>
    #userAddress {
        width: 100%;
        height: 100%;
        border: 1px solid #333;
    }

    .addressTitle {
        width: 100%;
        height: 50px;
        line-height: 50px;
        font-size: 22px;
        text-indent: 30px;
        background: #eee;
    }

    .addressOperate {
        width: 100%;
        height: 300px;
        margin-top: 10px;
        border-bottom: 1px solid #eee;
    }

    .addressOperate>div {
        display: inline-block;
        width: 66%;
        height: auto;
        font-size: 20px;
        color: #555;
        margin-top: 10px;
    }
    .addressOperate>div:nth-of-type(n+5){
        width: 300px;
        height: 40px;
    }
    .addressOperate>div:nth-of-type(n+5)>button{
        width: 120px;
        height: 40px;
        border: 1px solid #ccc;
        outline: none;
        cursor: pointer;
        font-size: 18px;
    }
    .addressOperate>div:nth-of-type(n+5)>button:nth-of-type(1){
        background: #f99c11;
    }
    .addressOperate>div:nth-of-type(n+5)>button:nth-of-type(1):hover{
        background: #e88b00;
    }
    .addressOperate>div:nth-of-type(n+5)>button:nth-of-type(2){
        background: #f5f5f5;
    }
    .addressOperate>div:nth-of-type(n+5)>button:nth-of-type(2):hover{
        background: #eee;
    }
    .addressOperate>div>span {
        display: inline-block;
        width: 150px;
        text-align: right;
    }

    .addressOperate>div>input[type=text] {
        width: 200px;
        height: 40px;
        font-size: 18px;
        text-indent: 10px;
    }

    .ao-content {
        display: inline-block;
        width: 520px;
        height: 120px;
    }

    .addressOperate>div:nth-of-type(3)>span {
        vertical-align: top;
    }
    .ao-content>textarea{
        font-size: 18px;
        margin-top: 5px;
        outline: none;
        text-indent: 10px;
    }
    .addressBox{
        width: 100%;
        height: 180px;
        margin-top: 5px;
        border: 1px solid #333;
    }
    .addressHeader{
        width: 100%;
        height: 40px;
        background: #f5f5f5;
    }
    .addressInfo{
        width: 100%;
        height: 140px;
        border: 1px solid #333;
        overflow: hidden;
        overflow-y: scroll;
    }
</style>