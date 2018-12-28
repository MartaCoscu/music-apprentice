<template>
    <div>

        <button v-on:click.prevent="next">next</button>
                <button v-on:click.prevent="prev">prev</button>

    <siema ref="siema" class="siema" :options="options"  @init="initFunc" @change="changeFunc">

            <div class="slide" v-for="exercice in exercices" 
            :key="exercice.id"
            :exercice = "exercice">
            <exercice :exercice = "exercice"></exercice>
        
        </div>
        
        </siema>

</div>
    
</template>

<script>
    export default {

        data(){
            return{                    
                    options: {
                        duration: 200,
                        easing: 'ease-out',
                        perPage: 1,
                        startIndex: 0,
                        draggable: true,
                        multipleDrag: true,
                        threshold: 20,
                        loop: false,
                        rtl: false
                    },
      
                exercices:[
                    {
                        name: "uno"
                    },
                    {
                        name: "dos"
                    },
                    {
                        name: "tres"
                    },
                ]
            }
        },



        mounted() {
      /*      axios.get('/exercices').then((response) => {
                this.exercices = response.data;
                console.log("exercices: " + this.exercices); 
            });*/

            console.log('Component mounted.')
        },

          methods: {
            initFunc(){
                console.log("init"); 
            },

            changeFunc(){
                console.log("change");                 
            },

            next(){
                console.log("next"); 
                this.$refs.siema.next();
            },

            prev(){
                console.log("next"); 
                this.$refs.siema.prev();
            }        
        }
    }
</script>
