<template>
    <div class="footbox">
        <div class="footer-box">
            <div class="footbox-header">
                <div class="footbox-header-content" v-for="(header,index) in titleList" :key="index">
                    <a href="javascript:;">
                        <div class="imgposition" :class="'img'+index"></div>
                        <div>{{ header }}</div>
                    </a>
                </div>
            </div>
            <div class="footbox-content">
                <div class="footbox-content-title">
                    <ul class="footbox-content-title-list" v-for="(content,index) in infoList" :key="index">
                        <p>{{ content.title }}</p>
                        <a href="javascript:;" v-for="(list,indexs) in content.info" :key="indexs">
                            <li>{{ list }}</li>
                        </a>
                    </ul>
                </div>
                <div class="footbox-content-service">
                    <div class="footbox-content-service-number">400-088-6888</div>
                    <div class="footbox-content-service-desc">7x24小时客服热线（仅收市话费）</div>
                    <div class="footbox-content-service-contact">
                        <a href="javascript:;">
                            <span class="footbox-content-service-contact-img"></span>
                            <span>在线客服</span>
                        </a>
                    </div>
                    <div class="footbox-content-service-vmail">
                        <p>关注Vmall：</p>
                        <div>
                            <a href="javascript:;">
                                <span class="weixin"></span>
                            </a>
                            <a href="javascript:;">
                                <span class="baidu"></span>
                            </a>
                            <a href="javascript:;">
                                <span class="weibo"></span>
                            </a>
                            <a href="javascript:;">
                                <span class="huawei"></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footbox-foot">
                <div class="footbox-foot-icon">
                    <img src="https://res.vmallres.com/pimages//sale/2019-01/wLelYbpMVWbj9Xpaa5Fk.png" alt="">
                </div>
                <div class="footbox-foot-content">
                    <div class="footbox-foot-content-top">
                        <ul>
                            <li class="footlist" v-for="(footList,index) in footList" :key="index">
                                <a href="">{{ footList }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="footbox-foot-content-bottom">
                        <ul class="footbox-foot-content-list">
                            <li>
                                <a href="">隐私声明</a>
                            </li>
                            <li>
                                <a href="">服务协议</a>
                            </li>
                            <li>
                                <a href="">COOKIES</a>
                            </li>
                            <li>Copyright © 2012-2019 华为终端有限公司 版权所有</li>
                            <li>
                                <a href="">粤ICP备19015064号-4</a>
                            </li>
                            <li> 备案主体编号：32201911426827</li>
                        </ul>
                    </div>
                </div>
                <div class="footbox-foot-img">
                    <img src="https://res.vmallres.com/pimages//sale/2018-05/20180522101715775.jpg" alt="">
                    <img src="https://res.vmallres.com/pimages//template/content/2016/20160226162415360.png" alt="">
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    export default{
        name:'foot',
        data(){
            return{
                imgList:'https://res8.vmallres.com/20181205/images/echannel/icon/icon-header.png?20170620',
                titleList:[
                    '百强企业 品质保证',
                    '7天退货 15天换货',
                    '48元起免运费',
                    '1000家维修网点 全国联保'
                ],
                infoList:[
                    {
                        title:'购物相关',
                        info:[
                            "购物指南",
                            "配送方式",
                            "支付方式",
                            "常见问题"
                        ]
                    },
                    {
                        title:'保修与退换货',
                        info:[
                            "保修政策",
                            "退换货政策",
                            "退换货流程",
                            "保修状态查询",
                            "配件防伪查询"
                        ]
                    },
                    {
                        title:'维修与技术支持',
                        info:[
                            "售后网点",
                            "预约维修",
                            "手机维修",
                            "备件价格查询",
                            "上门服务"
                        ]
                    },
                    {
                        title:'特色服务',
                        info:[
                            "防伪查询",
                            "补购保障",
                            "以旧换新",
                            "礼品包装"
                        ]
                    },
                    {
                        title:'关于我们',
                        info:[
                            "公司介绍",
                            "华为商城简介",
                            "华为线下门店",
                            "荣耀线下门店",
                            "诚征英才",
                            "意见反馈"
                        ]
                    },
                    {
                        title:'友情链接',
                        info:[
                            "华为集团",
                            "华为CEO官网",
                            "荣耀官网",
                            "花粉俱乐部",
                            "网站地图"
                        ]
                    }
                ],
                footList:[
                    "华为集团",
                    "华为CBG官网",
                    "荣耀官网",
                    "花粉俱乐部",
                    "华为应用市场",
                    "EMUI",
                    "华为终端云空间",
                    "开发者联盟",
                    "华为商城手机版",
                    "网站地图"
                ]
            }
        }
    }
</script>


<style scoped>
    .footbox{
        width: 100%;
        height: 400px;
    }
    .footer-box{
        width: 1260px;
        height: auto;
        margin: 0 auto;
    }
    .footbox-header{
        width: 100%;
        height: 50px;
    }
    .footbox-header-content{
        display: inline-block;
        width: 308px;
        height: 50px;
    }
    .footbox-header-content:first-child{
        margin-left: 20px;
    }
    a{
        text-decoration: none;
        color: #000;
    }
    .footbox-header-content div{
        display: inline-block;
        font-size: 18px;
        vertical-align: middle;
    }
    .imgposition{
        width: 40px;
        height: 40px;
        margin-right: 15px;
        margin-top: 2px;
        background: url(https://res8.vmallres.com/20181205/images/echannel/icon/icon-header.png?20170620) no-repeat;
    }
    ul{
        list-style-type: none;
    }
    .img0{
        background-position: -358px -207px;
    }
    .img1{
        background-position: -438px -207px;
    }
    .img2{
        background-position: -398px -207px;
    }
    .img3{
        background-position: -478px -207px;
    }
    .footbox-content{
        width: 100%;
        height: 210px;
        margin-top: 15px;
        border-top: 1px solid #ccc;
        border-bottom: 1px solid #ccc;
    }
    .footbox-content-title{
        width: 890px;
        height: 160px;
        margin-top: 30px;
        border-right: 1px solid #ccc;
    }
    .footbox-content-title-list{
        display: block;
        float: left;
        width: 140px;
        height: 160px;
        margin-right: 5px;
    }
    .footbox-content-title-list>p{
        font-size: 14px;
        margin-bottom: 10px;
    }
    .footbox-content-title-list>a>li{
        font-size: 12px;
        color: #777;  
        margin-top: 6px;
    }
    .footbox-content-title-list>a>li:hover{
        color: crimson;
    }
    .footbox-content-service{
        float: right;
        width: 260px;
        height: 160px;
        margin-top: -160px;
    }
    .footbox-content-service-number{
        font-size: 24px;
        font-weight: 900;
        font-stretch:ultra-condensed;
        color: #575757;
        text-align: center;
    }
    .footbox-content-service-desc{
        font-size: 15px;
        text-align: center;
        line-height: 30px;
    }
    .footbox-content-service-contact{
        position: relative;
        width: 180px;
        height: 35px;
        margin-top: 8px;
        margin-left: 45px;
        border-radius: 17px;
        background: #333;
    }
    .footbox-content-service-contact>a{
        position: absolute;
        display: block;
        width: 100px;
        height: 20px;
        margin-left: 45px;
        margin-top: 5px;
    }
    .footbox-content-service-contact span{
        font-size: 14px;
        color: #fff;
    }
    .footbox-content-service-contact-img{
        display: inline-block;
        width: 25px;
        height: 15px;
        margin-top: 4px;
        background: url(../../src/assets/images/contact.png) no-repeat;
    }
    .footbox-content-service-vmail{
        position: relative;
        width: 220px;
        height: 30px;
        margin-top: 15px;
        margin-left: 20px;
    }
    .footbox-content-service-vmail>p{
        position: absolute;
        display: inline;
        font-size: 14px;
        top: 5px;
    }
    .footbox-content-service-vmail>div{
        margin-left: 80px;
    }
    .footbox-content-service-vmail span{
        display: inline-block;
        width: 20px;
        height: 20px;
        margin-left: 8px;
        margin-top: 5px;
        background-size: cover;
    }
    .weixin{
        background: url(../../src/assets/images/weixin.png) no-repeat;
    }
    .baidu{
        background: url(../../src/assets/images/baidu.png) no-repeat;
    }
    .weibo{
        background: url(../../src/assets/images/weibo.png) no-repeat;
    }
    .huawei{
        background: url(../../src/assets/images/huawei.png) no-repeat;
    }
    .footbox-foot{
        width: 100%;
        height: 100px;
    }
    .footbox-foot div{
        float: left;
    }
    .footbox-foot-icon{
        width: 82px;
        height: 20px;
        margin-top: 35px;
        margin-right: 20px;
    }
    .footbox-foot-icon>img{
        width: 100%;
        height: 100%;
    }
    .footbox-foot-content{
        width: 900px;
        height: 50px;
        margin-top: 30px;
    }
    .footlist{
        font-size: 13px;
        margin-right: 10px;
        float: left;
    }
    .footlist>a:hover{
        color: crimson;
    }
    .footbox-foot-content-list>li{
        font-size: 13px;
        float: left;
        margin-right: 10px;
        margin-top: 5px;
        color: #aaa;
    }
    .footbox-foot-content-list>li>a{
        color: #999;
    }
    .footbox-foot-content-list>li>a:hover{
        color: crimson;
    }
    .footbox-foot-img{
        display: inline-block;
        width: 190px;
        height: 50px;
        margin-top: 30px;
    }
    .footbox-foot-img>img{
        margin-left: 10px;
    }
</style>