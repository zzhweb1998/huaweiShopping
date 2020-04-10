import Vue from 'vue'
import Router from 'vue-router'

//用户界面路由
import userMain from '@/components/user/userMain.vue'
import userLogin from '@/components/user/userLogin.vue'
import frontContent from '@/components/user/front/frontContent.vue'
import searchGoods from '@/components/user/front/searchGoods.vue'
import goodsDetailed from '@/components/user/front/goodsDetailed.vue'
import userDetailed from '@/components/user/front/userDetailed.vue'
import userInfo from '@/components/user/front/userDetailed/userContent/userInfo.vue'
import userAddress from '@/components/user/front/userDetailed/userContent/userAddress.vue'
import userShopcar from '@/components/user/front/userDetailed/userContent/userShopcar.vue'
import userOrders from '@/components/user/front/userDetailed/userContent/userOrders.vue'
import userMoney from '@/components/user/front/userDetailed/userContent/userMoney.vue'
import addressAdd from '@/components/user/front/userDetailed/userContent/addressAdd.vue'
import ordersDetailed from '@/components/user/front/userDetailed/userContent/ordersDetailed.vue'

//管理员界面路由
import adminMain from '@/components/admin/adminMain.vue'
import adminLogin from '@/components/admin/adminLogin.vue'
import adminAdd from '@/components/admin/after/content/adminAdd.vue'
import adminInfo from '@/components/admin/after/content/adminInfo.vue'
import goodsAdd from '@/components/admin/after/content/goodsAdd.vue'
import goodsDetailed2 from '@/components/admin/after/content/goodsDetailed.vue'
import goodsInfo from '@/components/admin/after/content/goodsInfo.vue'
import goodsPurchase from '@/components/admin/after/content/goodsPurchase.vue'
import goodsStock from '@/components/admin/after/content/goodsStock.vue'
import ordersDetailed2 from '@/components/admin/after/content/ordersDetailed.vue'
import ordersInfo from '@/components/admin/after/content/ordersInfo.vue'
import pictureBrowse from '@/components/admin/after/content/pictureBrowse.vue'
import pictureDetailed from '@/components/admin/after/content/pictureDetailed.vue'
import purchaseInfo from '@/components/admin/after/content/purchaseInfo.vue'
import userAdd from '@/components/admin/after/content/userAdd.vue'
import userInfo2 from '@/components/admin/after/content/userInfo.vue'
import manageCarousel from '@/components/admin/after/content/manageCarousel.vue'
import adminUpdate from '@/components/admin/after/content/adminUpdate.vue'
import goodsUpdate from '@/components/admin/after/content/goodsUpdate.vue'
import userUpdate from '@/components/admin/after/content/userUpdate.vue'
import adminStatistics from '@/components/admin/after/content/adminStatistics.vue'

Vue.use(Router)


// 解决重复点击导航路由报错
const originalPush = Router.prototype.push;
Router.prototype.push = function push(location) {
  return originalPush.call(this, location).catch(err => err);
}

export default new Router({
  routes: [
    {
      path: '/user',
      name: 'userMain',
      component: userMain,
      children:[
        {
          path: '/',
          name: 'frontContent',
          component: frontContent
        },
        {
          path: 'searchGoods',
          name: 'searchGoods',
          component: searchGoods
        },
        {
          path: 'goodsDetailed',
          name: 'goodsDetailed',
          component: goodsDetailed
        },
        {
          path: 'userDetailed',
          name: 'userDetailed',
          component: userDetailed,
          children:[
            {
              path: 'userInfo',
              name: 'userInfo',
              component: userInfo
            },
            {
              path: 'userAddress',
              name: 'userAddress',
              component: userAddress
            },
            {
              path: 'userShopcar',
              name: 'userShopcar',
              component: userShopcar
            },
            {
              path: 'userOrders',
              name: 'userOrders',
              component: userOrders
            },
            {
              path: 'userMoney',
              name: 'userMoney',
              component: userMoney
            },
            {
              path: 'addressAdd',
              name: 'addressAdd',
              component: addressAdd
            },
            {
              path: 'ordersDetailed',
              name: 'ordersDetailed',
              component: ordersDetailed
            },
          ]
        },
      ]
    },
    {
      path:'/userLogin',
      name:'userLogin',
      component: userLogin
    },
    {
      path:'/admin',
      name:'adminMain',
      component: adminMain,
      children:[
        {
          path:'adminAdd',
          name:'adminAdd',
          component: adminAdd
        },
        {
          path:'adminInfo',
          name:'adminInfo',
          component: adminInfo
        },
        {
          path:'goodsAdd',
          name:'goodsAdd',
          component: goodsAdd
        },
        {
          path:'goodsDetailed',
          name:'goodsDetailed2',
          component: goodsDetailed2
        },
        {
          path:'goodsInfo',
          name:'goodsInfo',
          component: goodsInfo
        },
        {
          path:'goodsPurchase',
          name:'goodsPurchase',
          component: goodsPurchase
        },
        {
          path:'goodsStock',
          name:'goodsStock',
          component: goodsStock
        },
        {
          path:'ordersDetailed',
          name:'ordersDetailed2',
          component: ordersDetailed2
        },
        {
          path:'ordersInfo',
          name:'ordersInfo',
          component: ordersInfo
        },
        {
          path:'pictureBrowse',
          name:'pictureBrowse',
          component: pictureBrowse
        },
        {
          path:'pictureDetailed',
          name:'pictureDetailed',
          component: pictureDetailed
        },
        {
          path:'purchaseInfo',
          name:'purchaseInfo',
          component: purchaseInfo
        },
        {
          path:'userAdd',
          name:'userAdd',
          component: userAdd
        },
        {
          path:'userInfo',
          name:'userInfo2',
          component: userInfo2
        },
        {
          path:'manageCarousel',
          name:'manageCarousel',
          component: manageCarousel
        },
        {
          path:'adminUpdate',
          name:'adminUpdate',
          component: adminUpdate
        },
        {
          path:'goodsUpdate',
          name:'goodsUpdate',
          component: goodsUpdate
        },
        {
          path:'userUpdate',
          name:'userUpdate',
          component: userUpdate
        },
        {
          path:'',
          name:'adminStatistics',
          component: adminStatistics
        },
      ]
    },
    {
      path:'/adminLogin',
      name:'adminLogin',
      component: adminLogin
    },
    {
      path: '*',
      redirect:'/user' //未定义的路由都跳转到/admin
    },
  ],
  mode: 'history' //去掉(http://localhost:8080/#/)的#/
})
