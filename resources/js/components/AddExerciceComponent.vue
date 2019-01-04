<template>
    <div class="ma-around">

        <div class="ma-container-exercices-session">
            <ul>
                <li>Selecciona el ejercicio</li>
        <li><select  v-on:change="onUpdate" v-model="exercice.id">
        <option v-for="exercice in exercices" name="exercice" 
        :exercice="exercices" v-bind:value="exercice.id"> {{ exercice.name }}</option>
        </select></li>



        <li><label class="ma-label-text" for="tempo">Tempo: </label></li>
        <li><input v-on:change="onUpdate"  type="number" max="250" min="40" name="tempo"  v-model="exercice.tempo"></li>
        <li><label class="ma-label-text" for="seconds">Seconds: </label></li>
        <li><input type="number" v-on:change="onUpdate" max="3600" min="5"  name="seconds"  v-model="exercice.seconds"></li>
        <li><button v-on:click.prevent="onBorrar">Borrar</button></li>
    </ul>
    </div>
    </div>
</template>

<script>
    export default {
        props:{
            exercice:{
            },
            index: {
            }
        },
        data() {
            return {
                toSend:{
                    tempo: 120,
                    seconds: 80,
                    exercice: '',    
                    myIndex: ''   
                },
                exercices:[
                    {

                    }
                ],

            };
        },

        mounted() {
            console.log('Component mounted.');
          //  this.handleResize();
            axios.get('/exercices').then((response) => {
                this.exercices = response.data;
                this.exercice.id = this.exercices[0].id;
               
                           //     this.$refs.siema.init(); 
            });

            this.toSend.myIndex = this.index; 

        },

        methods:{
            onBorrar(){
                console.log("on borrar"); 
                this.$emit("onDelete"); 
            },

            onUpdate(){
           /*     this.toSend.exercice.id = this.toSend.exercice.id;
                this.toSend.exercice.tempo = this.toSend.exercice.tempo;
                this.toSend.exercice.seconds = this.toSend.exercice.seconds;*/


            //    this.exercice.id = this.$refs.select.value;

                this.$emit("onUpdate");
            }
        }
    }
</script>
