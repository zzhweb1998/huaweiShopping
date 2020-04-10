<template>
    <div>
        <userSelect></userSelect>
        <userContent></userContent>
    </div>
</template>


<script>
    import userSelect from '@/components/user/front/userDetailed/userSelect.vue'
    import userContent from '@/components/user/front/userDetailed/userContent.vue'
    export default {
        data() {
            return {}
        },
        components: {
            userSelect,
            userContent
        }
    }
</script>