<template>
    <div id="adminMain">
        <afterHeader></afterHeader>
        <div class="adminContent">
            <afterSelect></afterSelect>
            <afterContent></afterContent>
        </div>
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
        border: 1px solid #333;
    }
    .adminContent{
        width: 100%;
        height: 90%;
        border: 1px solid #333;
    }
</style>