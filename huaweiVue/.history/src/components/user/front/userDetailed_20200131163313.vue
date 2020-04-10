<template>
    <div>
        <userSelect></userSelect>
        <router-view></router-view>
    </div>
</template>


<script>
    import userSelect from '@/components/user/front/userDetailed/userSelect.vue'
    export default {
        data() {
            return {}
        },
        components: {
            userSelect
        }
    }
</script>