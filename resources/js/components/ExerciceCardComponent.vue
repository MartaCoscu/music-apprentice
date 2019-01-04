<template>
    <div>
        <a href=""  v-on:click.prevent="onShow()" ><div class="ma-exerciceCard">
            {{ exercice.name }}
        </div></a>
    </div>
</template>

<script>
    export default {
        props: ['exercice'],

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
