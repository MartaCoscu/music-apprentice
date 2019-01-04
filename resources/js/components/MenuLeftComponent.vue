<template>
    <div class="ma-menu-left">
    	<a href="" v-on:click.prevent="onSelect(0)"><div class="ma-name-user">
    		{{ user.name }}
            <img v-bind:src="user.avatar_url"/> 
    	</div></a>
    	<opcionMenu name="Ejercicios" img="images/icons/ejercicio.png" @onSelect="onSelect(1)"></opcionMenu>
    	<opcionMenu name="Sesiones" img="images/icons/sesiones.png"  @onSelect="onSelect(2)"></opcionMenu>
    	<opcionMenu name="Revisiones" img="images/icons/stats.png" ></opcionMenu>
        <div class="ma-button">    
        <button v-on:click.prevent="logout">Cerrar sesión</button>
        </div>

    </div>
</template>

<script>
    export default {
        mounted() {
            this.avatar = this.user.avatar_url; 
            console.log(this.user.name); 
        },

        props:{
            user:{},
        },

        methods:{
            onSelect(i){
                console.log("on select"); 
                this.$emit("onChangeSection", i); 

            },

            logout(){
                console.log("logout");
                this.$emit("logout");     
            }
        }
    }
</script>
