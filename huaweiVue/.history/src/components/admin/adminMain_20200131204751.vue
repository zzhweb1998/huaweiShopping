<template>
    <div id="adminMain">
        <afterHeader></afterHeader>
        <afterSelect></afterSelect>
        <afterContent></afterContent>
    </div>
</template>

<script>
    import afterHeader from '@/components/admin/after/afterHeader.vue'
    import afterSelect from '@/components/admin/after/afterSelect.vue'
    import afterContent from '@/components/admin/after/afterContent.vue'
    export default {
        data() {
            return {}
        },
        components: {
            afterHeader,
            afterSelect,
            afterContent
        }
    }
</script>

<style>
    body>div {
        height: 100%;
    }

    #adminMain {
        height: 100%;
        background: red;
    }
</style>