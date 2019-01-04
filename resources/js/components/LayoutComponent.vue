<template>
    <div class="ma-layout">
        <nav>
            <navbar></navbar>
            <icons @onChangeSection="onChangeSection"></icons>
        </nav>

        <div v-if="forcelogin">
            <register @logged="onLogged()"></register>
        </div>
        <div v-else class="ma-content">
            <menuleft :user="user" @logout="logout" @onChangeSection="onChangeSection"></menuleft>
            <mainsection @checkUser="checkUser" :user="user" ref="mainsection">

            </mainsection>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                user:{},
                forcelogin: true,
                section: 0
            };
        },

    mounted() {
        this.checkUser();    
    },

      methods: {

        checkUser(){
            console.log("check user"); 
          axios
          .get('/loggedin')
          .then((response) => {
            if (response.data.logged){
                this.forcelogin = false;
                this.user = response.data.user; 
            } else{
                this.forcelogin = true;
            }            
        })
          .catch(error => {
            console.log(error); 
        })             
        },

        onLogged(){
            this.forcelogin = false;
        },

        logout(){
            console.log("logout"); 
            axios
            .get('/logout')
            .then((response) => {
                this.forcelogin = true;
            })
            .catch(error=>{
                console.log(error); 
            })
        },

        onChangeSection(i){
            console.log("seession"); 
            this.$refs.mainsection.onChangeSection(i);
        }
    }
}
</script>
