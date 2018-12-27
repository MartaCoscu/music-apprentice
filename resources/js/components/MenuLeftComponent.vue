<template>
    <div class="ma-menu-left">
    	<div class="ma-name-user">
    		<img src="images/icons/icon.png"/> 
    		Nombre de usuario
    	</div>
    	<opcionMenu name="Ejercicios"></opcionMenu>
    	<opcionMenu name="Sesiones"></opcionMenu>
    	<opcionMenu name="Revisiones"></opcionMenu>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
