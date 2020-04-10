<template>
    <div id="userDetailed">
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

<style>
    #userDetailed{
        width: 1300px;
        height: 550px;
        border: 1px solid #333;
    }
</style>