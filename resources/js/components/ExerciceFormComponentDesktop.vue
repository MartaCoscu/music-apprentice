<template>
    <div class="ma-form">
        <h1>NUEVO EJERCICIO</h1>
        <div class="ma-error" v-for="error in ma_errors">
            {{ error }}
        </div>
        <form method="POST" action="" v-on:submit.prevent="onSubmit()">
            <ul>
                <li><label class="ma-label-text" for="name">Nombre del ejercicio:</label></li>
                <li> <input type="text" v-model="name" class="ma-input-text" name="name" required>
                </li>

                <li><label class="ma-label-text" for="categoria_id">Categoria:</label></li>
                <li><select v-model="categoria_id">
        <option v-for="categoria in categories" name="exercice" 
        :categoria="categories" v-bind:value="categoria.id"> {{ categoria.name }}</option>
        </select>
            </li>

            <li><label class="ma-label-text" for="description">Resumen:</label></li> 
            <textarea class="ma-input-text" v-model="description" name="description"></textarea></li>
        </ul>
    </form>
    <div class="ma-editor-form">
        <ul>
            <li><label class="ma-label-text ma-align-center" for="description">Crea el ejercicio:</label></li> 
            <li><exerciceEditor v-if="edit" @updatedHtml="updateContent" :text="exercice.text"></exerciceEditor>
<exerciceEditor v-else @updatedHtml="updateContent" :text="exercice.text"></exerciceEditor>
            </li>
        </br>
        <li class="ma-button"><button type="submit" v-on:click.prevent="onSubmit"><span v-if="edit">Actualizar</span><span v-else>Crear</span></button></li></ul>
    </div>
</div>
</template>

<script>
    export default {
        props: {
            exercice:
            {
                default: 
                    function () { 
                        return {

                        } 
                    }   
            },
            edit:
            {
                default: false, 
            } 
        },

        data(){
            return{                    
                name: "name",
                description: "description",
                categoria_id: 1,
                session_id: -1,
                text:'',
                ma_errors: [
                ],    
                categories:[
                ]            
            }
        },

        mounted() {

            if (this.edit == true){
                this.name = this.exercice.name, 
                this.description = this.exercice.description, 
                this.categoria_id = this.exercice.categoria_id,
                this.text = this.exercice.text
            }

            let formData = new FormData();

                axios.get('/exercices/create',formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then((response) => {
                    this.categories = response.data;  
                    this.$emit('onShow', response.data.exercice.id); 

                })
                .catch((error) => {
                    console.log("error" + error)
                })
        },

        methods: {

            updateContent(html){
                console.log("update content" + html); 
                this.text = html; 
            },
            onSubmit(){
                let formData = new FormData();
                formData.append('name', this.name);
                 

                formData.append('description', this.description);
                formData.append('categoria_id', this.categoria_id);
                formData.append('session_id', this.session_id);
                formData.append('text',this.text);
            if(this.edit == true){

                formData.append('_method', 'patch'); 
                axios.post('/exercices/'+this.exercice.id, formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then((response) => {
                    console.log(response.request); 
                    this.$emit('onShow', this.exercice.id); 

                })
                .catch((error) => {
                    console.log("error" + error)
                })
            } else {


               axios.post('/exercices',formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then((response) => {
                    console.log(response.data.exercice.id); 
                    this.$emit('onShow', response.data.exercice.id); 

                })
                .catch((error) => {
                    console.log("error" + error)
                }) 
            }

        }
    }
}
</script>
