<template>
    <div>
        <h1>{{ exercice.name }}</h1>
        

        <p class="showExercice" v-html="realText"></p>

        <div class="ma-button">
        <button v-on:click.prevent="onBack()">Back</button>
        <button v-on:click.prevent="onEdit()">Edit</button>
        <button v-on:click.prevent="onDelete()">Delete</button>
    </div>

    </div>
</template>

<script>
    export default {
        props: {
            exercice: {}, 
        },

        data() {
            return {
                realText: '',
            };
        },

        mounted() {
            console.log('Component mounted.');

            this.realText = this.exercice.text.split('[[').join('<');
            this.realText = this.realText.split(']]').join('>');

        },

        methods:{
            onBack(){
                this.$emit("onList"); 
            },

            onEdit(){
                console.log("edit"); 
                this.$emit("onEdit", this.exercice.id); 
            },

            onDelete(){
                let formData = new FormData();
                formData.append('_method', 'delete'); 

                axios.post('/exercices/'+this.exercice.id ,formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then((response) => {
                    this.$emit('onList'); 

                })
                .catch((error) => {
                    console.log("error" + error)
                })
            }
        }
    }
</script>
