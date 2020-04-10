<template>
    <h1>用户界面</h1>
</template>

<script>
    export default{
        data(){
            return{}
        },
        created(){/api/user
            this.axios.post('').then(res =>{
                console.log(res.data);
                
            })
        }
    }
</script>