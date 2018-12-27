<template>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <exercice v-for="exercice in exercices" 
            :key="exercice.id"
            :exercice = "exercice">

            </exercice>
        </div>

    </div>
</template>

<script>
    export default {

        data(){
            return{
                exercices:[

                ]
            }
        },



        mounted() {
            axios.get('/exercices').then((response) => {
                this.exercices = response.data;
            });

            console.log('Component mounted.')
        }
    }
</script>
