<template>
    <div id="userMain">
        <frontHeader></frontHeader>
        <frontSearch></frontSearch>
        <router-view></router-view>
        <frontTail></frontTail>
    </div>
</template>

<script>
    import frontHeader from '@/components/user/front/frontHeader.vue'
    import frontSearch from '@/components/user/front/frontSearch.vue'
    import frontContent from '@/components/user/front/frontContent.vue'
    import frontTail from '@/components/user/front/frontTail.vue'
    export default{
        data(){
            return{}
        },
        created(){
            this.axios.post('/api/shop/user').then(res =>{
                console.log(res.data);
            })
        },
        components:{
            frontHeader,
            frontSearch,
            frontContent,
            frontTail
        }
    }
</script>

<style>
    #userMain{
        width: 1300px;
        margin: 10px auto;
        border: 1px solid #333;
    }
</style>