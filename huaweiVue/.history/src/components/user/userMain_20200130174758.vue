<template>
    <h1>用户界面</h1>
</template>

<script>
    export default{
        data(){

        },
        created(){
            this.axios.post('http://127.0.0.1:8000/api/user').then(res =>{
                console.log(res.data);
                
            })
        }
    }
</script>