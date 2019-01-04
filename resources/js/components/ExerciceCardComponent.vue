<template>
    <div>
        <a href=""  v-on:click.prevent="onShow()" >
            <div class="ma-exerciceCard">
            <div class="ma-exerciceCardName">
                <img class="ma_icon_session" v-bind:src="src"/>
                    {{ exercice.name }}
            </div></div></a>
    </div>
</template>

<script>
    export default {
        props: ['exercice'],

        data() {
            return {
                src : "",
            };
        },

        mounted() {
            console.log('Component mounted.');
            this.src = "categories/" + this.exercice.categoria_id+".png";
        },

         methods: {

            onShow(){
                this.$emit("onShow"); 
            },
        }
    }
</script>
