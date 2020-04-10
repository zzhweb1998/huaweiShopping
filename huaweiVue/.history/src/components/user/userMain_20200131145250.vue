<template>
    <h1>用户界面</h1>
</template>

<script>
    import userMain from '@/components/user/front/frontHeader.vue'
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
            userMain
        }
    }
</script>