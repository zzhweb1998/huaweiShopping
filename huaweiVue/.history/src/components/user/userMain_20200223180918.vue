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
        margin: 0px auto;
    }
</style>