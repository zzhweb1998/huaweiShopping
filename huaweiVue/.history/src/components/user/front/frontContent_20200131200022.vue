<template>
    <div id="frontContent">
        <conCarousel></conCarousel>
        <conNewgoods></conNewgoods>
    </div>
</template>


<script>
    import conCarousel from '@/components/user/front/content/conCarousel.vue'
    import conNewgoods from '@/components/user/front/content/conNewgoods.vue'
    export default{
        data(){
            return{}
        },
        components:{
            conCarousel,
            conNewgoods
        }
    }
</script>

<style>
    #frontContent{
        width: 100%;
        height: auto;
        margin-top: 10px;
        border: 1px solid #333;
    }
</style>