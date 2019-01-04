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
    
            },

         methods: {

            onShow(){
                this.$emit("onShow"); 
            },
        }
    }
</script>
