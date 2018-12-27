<template>
	<div class="ma-user">
       <h1>EDITAR PERFIL DE USUARIO {{ user.name }}</h1>
       <img class="ma-user-pic" src="images/users/user.png"/>
       <form v-if="editMode">
          <ul>
            <li><label for="name">Nuevo avatar</label></li>
            <li><input name="image_file" type="file" accept=".gif,.jpg,.jpeg,.png"> </li>  
            <li><label for="name">Nombre de usuario:</label></li>
            <li><input type="text" name="name" v-model="name"></li>
            <li><label for="email">E-mail:</label></li>
            <li><input type="text" name="mail" v-model="mail"></li>
            <li><label for="bio">Biografia:</label></li>
            <li><textarea name="password" v-model="bio"></textarea></li>    
        </ul>

        <button type="submit" class="btn btn-primary">
            Enviar
        </button>      



    </form>
    <div v-else>INFO DEL USUARIO</div>


    <form>

    </form>
</div>
</template>

<script>

    export default {
    	props: ['name'],
        data() {
            return {
                editMode: false,
                user: {
                    
                }
            };
        },

        mounted() {
 

            console.log('Component mounted ok.')
        }
    }
</script>
