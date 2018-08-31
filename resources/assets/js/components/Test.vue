<template>
<div class="home">


{{jsonData}}


</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
            this.getJson();
        },
        data(){
            return {
                msg: 'hello',
                jsonData:''
            }
        },
        methods:{
            getJson(){
                fetch('http://127.0.0.1:8000/api/test')
                .then(response => {
                    return response.json();
                }).then(data => {
                    // Work with JSON data here
                    this.jsonData = data;
                    console.log(data);
                }).catch(err => {
                    // Do something for an error here
                });
            }
        }
    }
</script>