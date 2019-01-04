<template>
    <div class="ma-main-section">

            <perfilSection @checkUser="checkUser" :user="user" v-if="perfil"></perfilSection>

            <exercicesSection ref="exercices" v-if="ejercicios"></exercicesSection>

            <sessionsSection ref="sesiones" v-if="sesiones"></sessionsSection>

    </div>
</template>

<script>
    export default {

        props:{
            section:{
                default: 0,
            },
            user:{

            }
        },

        data(){
            return {
                perfil: false, 
                ejercicios: true,
                sesiones: false
            }
        },

        methods:{
            onChangeSection(i){
                this.perfil = false;
                this.ejercicios = false;
                this.sesiones = false;

                switch(i){
                    case 0:
                        this.perfil = true;
                    break; 
                    case 1:
                        this.ejercicios = true;
                        if (this.$refs.exercices != null){
                            this.$refs.exercices.onList();       
                        }

                    break; 
                    case 2:
                        this.sesiones = true; 
                    if (this.$refs.sesiones != null){
                        this.$refs.sesiones.onList();
                    }
                    break; 
                }
            },
            checkUser(){
                console.log("1"); 
                this.$emit("checkUser"); 
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
    }
</script>
