<template>
    <div>
        <h1>{{ name }}</h1>

        <div v-if="play">
            <playSession :exercices = "exercices" :id="id" @onFinish="onFinish"></playSession>
            <div class="ma-button">
            <button v-on:click.prevent="onFinish">Finish</button></div>
        </div>

        <div v-else>
             <div class="ma-exercices-container" >
                <exerciceInSessionCard class="ma-exerciceCardParent" @onShow="onShow(exercice)" v-for="exercice in exercices"
                :key="exercice.id"
                :exercice = "exercice">
                </exerciceInSessionCard>
            </div>       
            <div class="ma-button">    
         <button v-on:click.prevent="playSession">Play</button></div>
        </div>     
       <div class="ma-button">     
        <button v-on:click.prevent="backToList">Back To List</button></div>

    </div>
</template>

<script>
    export default {
        props: {
            id: {}, 
        },

        data() {
            return {
                play: false,
                name: "", 
                exercices:[
                    {

                    },
                ],
            };
        },

        mounted() {
            console.log("show session");

                axios.get('/sessions/'+this.id,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then((response) => {
                   console.log(response.data.exercices); 
                    this.name = response.name;
                    this.exercices = response.data.exercices;

                })
                .catch((error) => {
                    console.log("error" + error)
                })
        },

        methods:{
            onBack(){
                this.$emit("onList"); 
            },

            playSession(){
                console.log("play"); 
                this.play = true; 
            },

            onFinish(){
                console.log("finish"); 
                this.play = false; 
            },

            backToList(){
                this.$emit("list");
            }

        }
    }
</script>
