<template>
    <div class="ma-login">
        <h1>LOG IN</h1>
        <div class="ma-error" v-for="error in ma_errors">
            {{ error }}
        </div>
        <form method="POST" action="" v-on:submit.prevent="onSubmit()">
            <ul>
                <li><label class="ma-label-text" for="email">e-mail</label>
                <input class="ma-input-text" id="email" v-model="email" type="email" name="email" value="mail" required autofocus></li>
                <li><label class="ma-label-text" for="password">Contraseña</label>
                <input id="password" class="ma-input-text" v-model="password" type="password" name="password" required></li>
                <li class="ma-align-center"><input type="checkbox" name="remember" id="remember">
                <label for="remember">Recordarme</label></li>
                <li class="ma-align-center"><button type="submit">Login</button></li>
                <li class="ma-align-center"><a href="" v-on:click.prevent="onClickSingUp()">Todavía no estoy registrado</a></li>
            </ul>
        </form>
    </div>
</template>

<script>
    export default {

        data(){
            return {
                email: '',
                password: '',
                ma_errors:[
                ]
            }
        },
        mounted() {
            console.log('Login mounted.')
        },

        methods: {
            onClickSingUp(){
                this.$emit('singup')
            },

            onSubmit(){
                this.ma_errors = [];
                let formData = new FormData();
                formData.append('email', this.email);
                formData.append('password', this.password);
                axios.post('/login',formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    })
                .then((response) => {
                    if (response.data.goHome == true){
                        this.$emit('logged');                         
                    } else {
                        this.ma_errors.push("Login incorrecto"); 
                    }
                })
                .catch((error) => {
                    console.log("error" + error)
                })
            }
        }
    }
</script>
