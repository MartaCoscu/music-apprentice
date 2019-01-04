<template>
    <div class="ma-singup">
        <h1>SING UP</h1>
        <div class="ma-error" v-for="error in ma_errors">
            {{ error }}
        </div>
        <form method="POST" action="" v-on:submit.prevent="onSubmit()">
            <ul>
                
                <input id="inputImg" v-on:change="onFileChange" accept=".jpg,.png"   name="input_img" type="file" style="display: none" />
                <li class="uploadAvatar" ref="avatar"><a v-on:click.prevent="onUploadImg" href=""><img class="ma-user-pic" v-bind:src="image_file"/></a></li>
               
                <li><label class="ma-label-text" for="name">Nombre de usuario:</label></li>
                    <li><input type="text" v-model="name" class="ma-input-text" name="name" required>
                </li>
                <li><label class="ma-label-text" for="email">E-mail:</label></li>
                    <li><input type="text" class="ma-input-text" v-model="email" name="email" required>
                </li>
                <li><label class="ma-label-text" for="bio">Biografia:</label></li>
                    <li><textarea class="ma-input-text" v-model="bio" name="bio" required></textarea>
                </li>  

                <li><label class="ma-label-text" for="password">Contraseña</label></li>
                    <li><input id="password" class="ma-input-text"  v-model="password" type="password" name="password" required>
                </li> 

                <li><label class="ma-label-text"  for="password">Repetir contraseña</label></li>
                <li><input id="password" v-model="new_password" class="ma-input-text" type="password" name="password" required>
                </li>   

                <li class="ma-button"><button type="submit">Sing Up</button></li>

                <li class="ma-button"><a href="" v-on:click.prevent="onClickLogin">Ya tengo una cuenta</a></li>
            </ul>
        </form>
    </div>
</template>

<script>
    export default {

        data(){
            return {
                image_file: 'users/user.png',
                name: '',
                email: '',
                password: '',
                new_password: '',
                bio: '',
                ma_errors:[
                ]
            }
        },
        mounted() {
            console.log('Login mounted.')
        },

        methods:{

            onSubmit(){
                console.log(this.data);
                if (this.validate()){
                    let formData = new FormData();
                    formData.append('image_file', this.image_file);
                    formData.append('name', this.name);
                    formData.append('email', this.email);
                    formData.append('password', this.password);
                    formData.append('bio', this.bio);

                    axios.post('/register',formData,
                        {
                            headers: {
                                'Content-Type': 'multipart/form-data'
                            }
                        })
                    .then((response) => {
                    console.log(response); 
                        this.ma_errors.push(response.data.text)
                        if (response.data.goHome == true){
                            this.$emit('logged'); 
                        } 
                    })
                    .catch((error) => {
                        console.log("error" + error)
                    })
                }
            },

            validate(){
                this.ma_errors = []; 
                if (this.name == ""){
                    this.ma_errors.push("el nombre no puede estar vacio")
                } 
                if (this.email == ""){
                    this.ma_errors.push("el email no puede estar vacio")                
                }

                if (this.password == ""){
                    this.ma_errors.push("la contraseña no puede estar vacía")
                }
                else if (this.password.length < 8) {
                    this.ma_errors.push("la contraseña debe tener más de 8 caracteres")                                   
                }
                else if (this.password != this.new_password){
                    this.ma_errors.push("las contraseñas no coinciden");                 
                }

                if (this.ma_errors.length>0){
                    return false;
                } else {
                    return true; 
                }
            },

            onClickLogin(){
                this.$emit('login')
            },

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
                        this.image_file=mystring; 
                        console.log(mystring); 
                     })
                    .catch((error) => {
                        console.log("error" + error);

                        this.ma_errors.push("Hubo un error al subir el archivo. Tamaño máximo: 8mb"); 
                    })             
                }
            },

            createImage(file) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    this.image_file = e.target.result;
                };
                reader.readAsDataURL(file);
            },

            onUploadImg(){
                $("#inputImg").trigger("click");
            }

        }
    }
</script>
