<template>
    <div>
        holi
        {{ window.width }}
        <exerciceFormDesktop v-if="window.greater">
        </exerciceFormDesktop>

        <exerciceFormMobile v-else>
        </exerciceFormMobile>

    </div>
</template>

<script>

    export default {

        data(){
            return{                    
                window: {
                    width: 0,
                    height: 0,
                    mobile: false
                }
            }
        },

        mounted() {

        },
        beforeDestroy() {
            this.editor.destroy()
        },
        created() {
            window.addEventListener('resize', this.handleResize)
            this.handleResize();
        },
        destroyed() {
            window.removeEventListener('resize', this.handleResize)
        },

        methods: {
            handleResize() {
                this.window.width = window.innerWidth;
                this.window.height = window.innerHeight;
                if (this.window.width > 992){
                    this.window.greater = true; 
                }else {
                    this.window.greater = false; 
                }
            } 
        }
    }
</script>
