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