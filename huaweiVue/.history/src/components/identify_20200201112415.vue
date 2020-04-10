<template>
    <span class="identify">
        <span class='identify-box'>
            <input type="text" placeholder="请输入验证码" class="identify-yanzhengma" v-model="picLyanzhengma">
            <span class="identify-code" @click="createCode" ref="clickCode">{{this.checkCode}}</span>
        </span>
    </span>
</template>

<script>
    export default {
        data() {
            return {
                code:'',
                checkCode:'',
                picLyanzhengma:'',
            }
        },
        methods: {
            // 图片验证码
            createCode() {
                //先清空验证码的输入
                this.code = '';
                this.checkCode = '';
                this.picLyanzhengma = '';
                //验证码的长度  
                var codeLength = 4;
                //随机数 
                var random = new Array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
                for (var i = 0; i < codeLength; i++) {
                    //取得随机数的索引（0~35）
                    var index = Math.floor(Math.random() * 36);
                    //根据索引取得随机数加到code上
                    this.code += random[index];
                }
                //把code值赋给验证码  
                this.checkCode = this.code;
            },
            clear(){
                this.$refs.clickCode.dispatchEvent(new MouseEvent('click'))
            }
        },
        created(){
            this.createCode()
            this.$emit('ifcode', {checkCode:this.checkCode,picLyanzhengma:this.picLyanzhengma})
        },
        updated(){
            this.$emit('ifcode', {checkCode:this.checkCode,picLyanzhengma:this.picLyanzhengma})
        }
    }
</script>

<style>
    .identify{
        display: inline-block;
    }
    .identify-box{
        width:100%;
        height: 100%;
    }
    .identify-yanzhengma{
        width: 200px;
        height: 30px;
        font-size: 18px;
    }
    .identify-code{
        display: inline-block;
        width: 80px;
        height: 30px;
        font-size: 18px;
        text-align: center;
        line-height: 30px;
        letter-spacing: 3px;
        color: brown;
        vertical-align: middle;
        cursor: pointer;
        border: 1px solid #333;
    }
</style>