<template>
    <div class="ma-singup">
        <h1>NUEVO EJERCICIO</h1>
        <div class="ma-error" v-for="error in ma_errors">
            {{ error }}
        </div>
        <form method="POST" action="" v-on:submit.prevent="onSubmit()">
            <ul>
                <li><label class="ma-label-text" for="name">Nombre del ejercicio:</label>
                <input type="text" v-model="name" class="ma-input-text" name="name" required>
                </li>

                <li><label class="ma-label-text" for="categoria_id">Categoria:</label></li>
                <select name="categoria_id" v-model="categoria_id">
                    <option value=0>Volvo</option>
                    <option value=1>Saab</option>
                    <option value=2>Fiat</option>
                    <option value=3>Audi</option>
                </select> 
                

                <li><label class="ma-label-text" for="description">Resumen:</label></li> 
                <textarea class="ma-input-text" v-model="description" name="description"></textarea>
                <exerciceEditor @updatedHtml="updateContent"></exerciceEditor>

                <li class="ma-align-center"><button type="submit">Crear</button></li>
            </ul>
        </form>
    </div>
</template>

<script>
    export default {

    data(){
        return{                    
            name: "name",
            description: "description",
            categoria_id: 1,
            session_id: -1,
            text:'',
            ma_errors: [
            ],
        }
    },

    mounted() {

    },

    beforeDestroy() {
        this.editor.destroy()
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
            axios.post('/exercices',formData,
            {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            })
            .then((response) => {
                console.log(response.data); 
            })
            .catch((error) => {
                console.log("error" + error)
            })
        }
    }
}
</script>
