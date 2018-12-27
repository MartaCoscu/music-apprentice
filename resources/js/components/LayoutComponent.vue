<template>
    <div class="ma-layout">
        <nav>
            <navbar></navbar>
            <icons></icons>
            <!--<button v-on:click="logOut()">logout</button>-->
        </nav>

        <div v-if="forcelogin">
            <register @logged="onLogged()"></register>
        </div>
        <div v-else class="ma-content">
            <menuleft></menuleft>
            <mainsection>

            </mainsection>
        </div>
    </div>
</template>

<script>
    export default {

        data(){
            return{
                forcelogin: true,
            };
        },

        mounted() {
          axios
          .get('/loggedin')
          .then((response) => {
            if (response.data.logged){
                this.forcelogin = false;
            } else{
                this.forcelogin = true;
            }            
        })
          .catch(error => {
            console.log(error); 
        })        
      },

      methods: {
        onLogged(){
            this.forcelogin = false;
        },

        logOut(){
            axios
            .get('/logout')
            .then((response) => {
                this.forcelogin = true;
            })
            .catch(error=>{
                console.log(error); 
            })
        }
    }
}
</script>
