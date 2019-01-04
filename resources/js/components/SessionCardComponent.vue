<template>
    <div>
        <a href=""  v-on:click.prevent="onShow()" ><div class="ma-exerciceCard">
            {{ session.name }}
        </div></a>
    </div>
</template>

<script>
    export default {
        props: ['session'],

        data() {
            return {

            };
        },

        mounted() {
            console.log('Component mounted.');
        },

         methods: {

            onShow(){
                this.$emit("onShow"); 
            },
        }
    }
</script>
