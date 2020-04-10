<template>
    <h1>用户界面用户区</h1>
</template>


<script>
    import userSelect from '@/components/user/front/userDetailed/userSelect.vue'
    export default {
        data() {
            return {}
        },
        created() {
            this.axios.post('/api/shop/user').then(res => {
                console.log(res.data);
            })
        },
        components: {
            frontHeader,
            frontSearch,
            frontContent,
            frontTail
        }
    }
</script>