<template>
    <div>
        <h1>CREA SESIÓN</h1>
        <form method="POST" action="" v-on:submit.prevent="onSubmit()">

            <ul>
                <li><label class="ma-label-text" for="image_file">Nombre de la sesión</label></li>
                <li><input type="text" v-model="name" class="ma-input-text" name="name" required></li>
            </ul>
            Ejercicios: 
            <addExercice v-for="(exercice, index)  in exercices" 
             :key="index" 
             :index="index"
             :exercice="exercice" 
             @onDelete = "onDelete(index)"
             @onUpdate = "onUpdate">
         </addExercice>
         <div class="ma-button">    
            <button v-on:click.prevent="onAdd">Añadir otro ejercicio</button>
            <button value="Submit">Crear </button>
        </div>
</form>
</div>
</template>

<script>
    export default {

        data() {
            return {
                name: "", 
                exercices:[
                {
                    id: "0",
                    tempo: "120",
                    seconds: "80"
                },
                ],
            };
        },

        mounted() {
            console.log('Component mounted.');

        },

        methods:{
            onBack(){
                this.$emit("onList"); 
            },
            onAdd(){
                console.log("on add"); 
                this.exercices.push({
                    id: "0",
                    tempo: "120",
                    seconds: "80"
                }) 
            },
            onDelete(index){
                this.exercices.splice(index); 
            },

            onUpdate(){
             console.log(this.exercices);     
         },

         onSubmit(){
            console.log("add sessions"); 
            let formData = new FormData();
            formData.append('name', this.name);
            formData.append('exercices', JSON.stringify(this.exercices)),
            axios.post('/sessions', formData,
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then((response) => {
                this.$emit("list");
                console.log(response.data); 

            })
            .catch((error) => {
                console.log("error" + error)
            })
        }
    }
}
</script>
