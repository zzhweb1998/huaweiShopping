<template>
    <h1>用户界面</h1>
</template>

<script>
    export default{
        data(){
            return{}
        },
        created(){
            this.axios.post('http://127.0.0.1:8000/api/shop/user').then(res =>{
                console.log(res.data);
            })
        }
    }
</script>