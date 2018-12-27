<template>
    <div>
        <login v-if="login" @singup="onsingup()" @logged="onLogged()"></login>
        <singup v-else @login="onlogin()" @logged="onLogged()"></singup>
    </div>
</template>

<script>
    export default {

        data(){
            return{
                login: false           
            };
        },

        mounted() {
            console.log('Login mounted.')
        },

        methods: {
            onsingup(){
                this.login = false
            },

            onlogin(){
                this.login = true
            },

            onLogged(){
                console.log("log"); 
                this.$emit("logged"); 
            }
        }
    }
</script>
