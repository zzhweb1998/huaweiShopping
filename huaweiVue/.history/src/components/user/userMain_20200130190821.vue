<template>
    <h1>用户界面</h1>
</template>

<script>
    export default{
        data(){
            return{}
        },
        created(){
            this.axios.post('/api/user').then(res =>{
                console.log(res.data);
                
            })
        }
    }
</script>