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
                    <div class="selctCity">
                        <li>
                            <div class="left">
                                <span>所在地区</span>
                            </div>
                            <div class="right r">
                                <div class="city" @click="toAddress">{{city}}</div>
                                <i class="arrow-r"> </i>
                            </div>
                        </li>
                        <v-distpicker type="mobile" @selected='selected' v-show="addInp">
                        </v-distpicker>
                        <div class="mask" v-show="mask"></div>
                    </div>
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
                city: '请选择',
                addInp: false,
                mask: false
            }
        },
        created() {

        },
        methods: {
            //在methodes中定义方法
            // 点击弹出三级联动
            toAddress() {
                this.mask = true;
                this.addInp = true;
            },
            // 省市区三级联动
            selected(data) {
                this.mask = false;
                this.addInp = false;
                this.city = data.province.value + ' ' + data.city.value + ' ' + data.area.value
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
        width: 600px;
        height: 100px;
        border: 1px solid #333;
    }

    .addressOperate>div:nth-of-type(3)>span {
        vertical-align: top;
    }
    .selctCity{
        width: 100%;
        height: 40px;
    }
</style>