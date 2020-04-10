<template>
    <div>
        <frontHeader></frontHeader>
    </div>
</template>

<script>
    import frontHeader from '@/components/user/front/frontHeader.vue'
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
            frontHeader
        }
    }
</script>