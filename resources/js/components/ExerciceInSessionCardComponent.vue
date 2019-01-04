<template>
    <div>
        <a href=""  v-on:click.prevent="onShow()" ><div class="ma-exerciceCard ma-exerciceCardSession">
            <div class="ma-exerciceCardName ">
                <img class="ma_icon_session" v-bind:src="src"/>
                {{ exercice.name }}
            </div>
            <div  class="ma-exerciceCardValues">
                {{ tempo }}</br>
                {{ seconds }}
            </div>
        </div></a>
    </div>
</template>

<script>
    export default {
        props: ['exercice', 'session'],

        data() {
            return {
                src:"",
                tempo: "",
                seconds: ""
            };
        },

        mounted() {
            this.src = "categories/" + this.exercice.categoria_id+".png"; 

            let formData = new FormData();
            formData.append('session', this.session);
            formData.append('exercice', this.exercice.id);

            axios.post('/exerciceInSession', formData,
            {
                headers: {
                    'Content-Type': 'multipart/form-data',
                }
            })
            .then((response) => {
               console.log(response); 
               this.tempo = response.data.tempo;
               this.seconds = response.data.seconds;
            })
            .catch((error) => {
               // console.log("error" + error)
            })        
        },

        methods: {

            onShow(){
                this.$emit("onShow"); 
            },
        }
    }
</script>
