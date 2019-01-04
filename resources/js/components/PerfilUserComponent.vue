<template>
	<div class="ma-user">
        
        <input v-if="edit" type="text" name="name" v-model="myuser.name">
        <h1 v-else>{{ myuser.name }}</h1>
        
        <div v-if="edit">
            <input id="inputImg" v-on:change="onFileChange" accept=".jpg,.png"   name="input_img" type="file" style="display: none" />
            <a v-on:click.prevent="onUploadImg" href=""><img class="ma-user-pic" v-bind:src="myuser.avatar_url"/></a>
        </div>
        <img v-else class="ma-user-pic" v-bind:src="myuser.avatar_url"/>
        <p class="ma-info ma-header">Email</p>
        <input v-if="edit" type="email" name="email" v-model="myuser.email">
        <p v-else class="ma-bio">{{ myuser.email }}</p>

        <p class="ma-info ma-header">Biografia</p>
        <textarea v-if="edit" name="bio" v-model="myuser.bio"></textarea>
        <p v-else class="ma-bio">{{ myuser.bio }}</p>

        <div v-if="edit" class="ma-button">
            <button v-on:click.prevent="save">Actualizar</button>
        </div>
        <div v-if="edit" class="ma-button">
            <button v-on:click.prevent="cancelar">Cancelar</button>
        </div>
        <div v-else class="ma-button">
            <button v-on:click.prevent="editar">Editar</button>
        </div>
    </div>
</template>

<script>

    export default {
    	props: ['user'],
        data() {
            return {
                edit: false,
                cuser: {},
                myuser:{
                    name: "",
                    email: "",
                    bio:"",
                    avatar_url:"",
                    id:"",
                }
            };
        },

        mounted() {
            this.myuser.name = this.user.name;
            this.myuser.email = this.user.email;
            this.myuser.bio = this.user.bio;
            this.myuser.avatar_url = this.user.avatar_url;
            this.myuser.id = this.user.id;
            this.cuser = this.user;
        },

        methods:{
           onFileChange(e) {
                this.ma_errors= [];
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                   // this.createImage(files[0]);
                   this.file = files[0];

                   if (this.file.size > 8000000){

                    this.ma_errors.push("Hubo un error al subir el archivo. Tamaño máximo: 8mb"); 
                } else {
                    let formData = new FormData();
                    formData.append('file', this.file);

                    axios({
                        method: 'post',
                        url: '/avatar',
                        headers:{'Content-Type': 'multipart/form-data', 'X-Content-Type-Options': 'nosniff'},
                        data: formData
                    })
                    .then((response) => {
                        console.log(response.data); 
                        let mystring = "users/" + response.data.url; 
                        this.myuser.avatar_url=mystring;
                        console.log(mystring); 
                     })
                    .catch((error) => {
                        console.log("error" + error);

                        this.ma_errors.push("Hubo un error al subir el archivo. Tamaño máximo: 8mb"); 
                    })             
                }
            },

           onUploadImg(){
                $("#inputImg").trigger("click");
            },

            editar(){
                this.edit = true; 
            },

            cancelar(){
                this.edit = false;
            },

            save(){
                let formData = new FormData();
                formData.append('_method', 'patch'); 
                formData.append('id', this.myuser.id);
                formData.append('name', this.myuser.name);
                formData.append('bio', this.myuser.bio);
                formData.append('email', this.myuser.email);
                formData.append('avatar_url', this.myuser.avatar_url);
                
                axios.post('/user/', formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then((response) => {
                    console.log(response); 
                    //this.user = response.data;
                    this.edit = false;
                    this.$emit("checkUser");  


                })
                .catch((error) => {
                    console.log("error" + error)
                })
            }

        }
    }
</script>
