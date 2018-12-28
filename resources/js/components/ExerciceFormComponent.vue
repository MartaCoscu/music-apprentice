<template>
    <div>
        holi
        {{ window.width }}
        <div v-if="window.greater">
            desktop
        </div>

        <div v-else>
            mobile
        </div>

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
        console.log('Component mounted.')
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
