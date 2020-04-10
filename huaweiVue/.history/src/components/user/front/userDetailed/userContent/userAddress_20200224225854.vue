<template>
    <div id="userAddress">
        <div class="addressTitle">收货地址管理</div>
        <div class="addressOperate">
            <div>
                <span>收货人：</span>
                <input type="text">
            </div>
            <div>
                <span>手机号码：</span>
                <input type="text">
            </div>
            <div>
                <span>收货地址：</span>
                <div class="ao-content">
                    <v-distpicker :placeholders="placeholders" @selected="onSelected"></v-distpicker>
                    <textarea cols="50" rows="3" placeholder="输入详细地址信息"></textarea>
                </div>
            </div>
            <div>
                <span>邮编：</span>
                <input type="text">
            </div>
        </div>
        <div class="addressBox">

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
                }
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
        border: 1px solid #333;
    }

    .addressOperate>div {
        width: 100%;
        height: auto;
        font-size: 20px;
        color: #555;
        margin-top: 10px;
        border: 1px solid #333;
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
        width: 800px;
        height: 100px;
        border: 1px solid #333;
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
</style>