<template>
    <div id="pictureDetailed">
        <div class="ac-header">
            商品详情图添加
        </div>
        <div class="ac-search">
            <span>商品ID：</span>
            <input type="text" v-model="keyword">
            <button @click="search">查询</button>
        </div>
        <div class="ac-pictureDetailed" v-show="showIf == 1">
            <iframe id="hide_iframe" name="hide_iframe" style="display:none;"></iframe>
            <form action="/api/shop/detailedPicture" method="POST" enctype="multipart/form-data" target="hide_iframe"
                style="display:none;">
                <input type="file" name="myFile" accept="image/jpeg,image/gif,image/png,image/jpg" ref="file"
                    @change="upload($event)">
                <input type="text" name="id" v-model="goodsInfo.goods_info_id">
                <input type="text" name="order" v-model="pictureOrder">
                <input type="submit" value="上传" ref="submit">
            </form>
            <p>{{goodsInfo.goods_info_name}} {{goodsInfo.goods_category}}</p>
            <div class="pictureDetailedBox" v-for="(pi,index) in pictureInfo" :key="index" @click="selPicture(pi.no)">
                <div class="pb-transverseDetailed"></div>
                <div class="pb-verticalDetailed"></div>
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
                    },
                    {
                        no: 9,
                        url: ''
                    },
                    {
                        no: 10,
                        url: ''
                    },
                    {
                        no: 11,
                        url: ''
                    },
                    {
                        no: 12,
                        url: ''
                    },
                    {
                        no: 13,
                        url: ''
                    },
                    {
                        no: 14,
                        url: ''
                    },
                    {
                        no: 15,
                        url: ''
                    },
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
                console.log(this.pictureOrder);

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
                this.axios.post("/api/shop/selectGD", {
                    id: this.keyword
                }).then(res => {
                    if (res.data == '') {
                        alert('无此商品ID')
                        this.keyword = ''
                        this.showIf = 0
                    } else {
                        this.pictureInfo.filter((item, index) => {
                            this.pictureInfo[index].url = ''
                        })
                        this.goodsInfo = res.data[0]
                        this.showIf = 1
                        this.axios.post("/api/shop/selectDetailed", {
                            id: this.goodsInfo.goods_info_id
                        }).then(res => {
                            res.data.filter(item => {
                                this.pictureInfo.filter((item2, index) => {
                                    if (item2.no == item.goods_picture_order) {
                                        this.pictureInfo[index].url = '../../../../../static/image/' + item.goods_picture_name
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
    #pictureDetailed {
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

    .ac-pictureDetailed {
        width: 80%;
        height: 500px;
        margin: 10px auto;
        overflow: hidden;
        overflow-y: scroll;
        border: 1px solid #ccc;
    }

    .ac-pictureDetailed>p {
        font-size: 20px;
        margin-left: 50px;
        margin-top: 10px;
    }

    .pictureDetailedBox {
        position: relative;
        width: 802px;
        height: 402px;
        margin-left: 50px;
        margin-top: 20px;
        cursor: pointer;
        border: 1px dashed #aaa;
    }

    .pb-transverseDetailed {
        position: absolute;
        top: 195px;
        left: 330px;
        width: 140px;
        height: 10px;
        background: #ccc;
        z-index: 1;
    }

    .pb-verticalDetailed {
        position: absolute;
        top: 130px;
        left: 395px;
        width: 10px;
        height: 140px;
        background: #ccc;
        z-index: 1;
    }

    .pictureDetailedBox>img {
        position: absolute;
        top: -1px;
        left: -1px;
        width: auto;
        height: 402px;
        z-index: 10;
    }
</style>