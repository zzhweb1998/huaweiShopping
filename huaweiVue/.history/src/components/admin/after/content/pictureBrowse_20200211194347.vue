<template>
    <div id="pictureBrowse">
        <div class="ac-header">
            商品流览图添加
        </div>
        <div class="ac-search">
            <span>商品编号：</span>
            <input type="text" v-model="keyword">
            <button @click="search">查询</button>
        </div>
        <div class="ac-picture" v-show="showIf == 1">
            <iframe id="hide_iframe" name="hide_iframe" style="display:none;"></iframe>
            <form action="/api/shop/browsePicture" method="POST" enctype="multipart/form-data" target="hide_iframe"
                style="display:none;">
                <input type="file" name="myFile" accept="image/jpeg,image/gif,image/png,image/jpg" ref="file"
                    @change="upload($event)">
                <input type="text" name="no" v-model="goodsInfo.goods_no">
                <input type="text" name="order" v-model="pictureOrder">
                <input type="submit" value="上传" ref="submit">
            </form>
            <p>{{goodsInfo.goods_info_name}} {{goodsInfo.goods_color}} {{goodsInfo.goods_configure}}</p>
            <div class="pictureBox" v-for="(pi,index) in pictureInfo" :key="index" @click="selPicture(pi.no)">
                <div class="pb-transverse"></div>
                <div class="pb-vertical"></div>
                <img :src=pi.url alt="">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                keyword: '',
                pictureInfo: [
                    {
                        no: 1,
                        url: ''
                    },
                    {
                        no: 2,
                        url: ''
                    },
                    {
                        no: 3,
                        url: ''
                    },
                    {
                        no: 4,
                        url: ''
                    },
                    {
                        no: 5,
                        url: ''
                    },
                    {
                        no: 6,
                        url: ''
                    },
                    {
                        no: 7,
                        url: ''
                    },
                    {
                        no: 8,
                        url: ''
                    }
                ],
                goodsInfo: '',
                pictureOrder: '',
                imgUrl: '',
                showIf: 0
            };
        },
        created() {

        },
        methods: {
            selPicture(no) {
                this.pictureOrder = no
                this.$refs.file.click()
            },
            upload(e) {
                this.isUpload = true;
                let file = e.target.files[0];
                let url = '';
                var reader = new FileReader();
                reader.readAsDataURL(file);
                let that = this;
                reader.onload = function (e) {
                    url = this.result.substring(this.result.indexOf(',') + 1);
                    that.imgUrl = 'data:image/png;base64,' + url
                    that.pictureInfo.filter((item, index) => {
                        if (item.no == that.pictureOrder) {
                            that.pictureInfo[index].url = that.imgUrl
                        }
                    })
                }
                this.$refs.submit.click()
            },
            search() {
                this.axios.post("/api/shop/selectGN", {
                    no: this.keyword
                }).then(res => {
                    if (res.data == '') {
                        alert('无此商品编号')
                        this.keyword = ''
                        this.showIf = 0
                    } else {
                        this.pictureInfo.filter((item, index) => {
                            this.pictureInfo[index].url = ''
                        })
                        this.goodsInfo = res.data[0]
                        this.showIf = 1
                        this.axios.post("/api/shop/selectBrowse", {
                            no: this.goodsInfo.goods_no
                        }).then(res => {
                            res.data.filter(item => {
                                this.pictureInfo.filter((item2, index) => {
                                    if (item2.no == item.browse_picture_order) {
                                        this.pictureInfo[index].url = '../../../../../static/image/' + item.browse_picture_name
                                    }
                                })
                            })
                        })
                    }
                })
            }
        }
    }
</script>

<style>
    #pictureBrowse {
        width: 100%;
        height: 100%;
    }

    .ac-header {
        width: 100%;
        height: 60px;
        background: #eee;
        font-size: 26px;
        font-weight: 600;
        line-height: 60px;
        text-indent: 100px;
        color: #555;
    }

    .ac-search {
        width: 100%;
        height: 60px;
        font-size: 20px;
        line-height: 60px;
        text-indent: 150px;
        border-bottom: 1px solid #ccc;
    }

    .ac-search>input[type=text] {
        width: 200px;
        height: 30px;
        font-size: 20px;
        text-indent: 5px;
        outline: none;
    }

    .ac-search>button {
        width: 80px;
        height: 30px;
        margin-left: 10px;
        font-size: 16px;
    }

    .ac-picture {
        width: 90%;
        height: 520px;
        margin: 20px auto;
        border: 1px solid #ccc;
    }

    .ac-picture>p {
        font-size: 20px;
        margin-left: 50px;
        margin-top: 10px;
    }

    .pictureBox {
        position: relative;
        float: left;
        width: 202px;
        height: 202px;
        margin-left: 50px;
        margin-top: 20px;
        cursor: pointer;
        border: 1px dashed #aaa;
    }

    .pb-transverse {
        position: absolute;
        top: 95px;
        left: 30px;
        width: 140px;
        height: 10px;
        background: #ccc;
        z-index: 1;
    }

    .pb-vertical {
        position: absolute;
        top: 30px;
        left: 95px;
        width: 10px;
        height: 140px;
        background: #ccc;
        z-index: 1;
    }

    .pictureBox>img {
        position: absolute;
        top: 0;
        left: 0;
        width: 200px;
        height: 200px;
        z-index: 10;
    }
</style>