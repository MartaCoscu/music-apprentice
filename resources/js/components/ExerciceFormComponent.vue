<template>
    <div>
        <exerciceFormDesktop  @list="onList()" @onShow="onShow" v-if="window.greater" :exercice=exercice :edit=edit>
        </exerciceFormDesktop>

        <exerciceFormMobile v-else>
        </exerciceFormMobile>

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
                window: {
                    width: 0,
                    height: 0,
                    mobile: false
                }
            }
        },
        methods: {

            onList(){
                this.$emit('list'); 
            },

            onShow(id){
                console.log("llamamos a la id: " + id);
                this.$emit('onShow', id); 
            },

            handleResize() {
                this.window.width = window.innerWidth;
                this.window.height = window.innerHeight;
                if (this.window.width > 992){
                    this.window.greater = true; 
                }else {
                    this.window.greater = false; 
                }
            } 
        },

        mounted() {

        },
        created() {
            window.addEventListener('resize', this.handleResize)
            this.handleResize();
        },
        destroyed() {
            window.removeEventListener('resize', this.handleResize)
        },
    }
</script>
