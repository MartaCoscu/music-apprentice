<template>
    <div class="ma-container ma-icons">
        <div class="ma-icons-container">
            <a><img class="ma-icon" src="images/icons/atras.png"></a>
            <a><img class="ma-icon" src="images/icons/lupa.png"></a>
            <a><img class="ma-icon" src="images/icons/stats.png"></a>
            <a href="" v-on:click.prevent="onSelect(2)"><img class="ma-icon" src="images/icons/sesiones.png"></a>
            <a href="" v-on:click.prevent="onSelect(1)"><img class="ma-icon" src="images/icons/ejercicio.png"></a>
            <a href="" v-on:click.prevent="onSelect(0)"><img class="ma-icon" src="images/icons/usuario.png"></a>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },

        methods:{
                onSelect(i){
                console.log("on select"); 
                this.$emit("onChangeSection", i); 
            },
        }
    }
</script>
