<template>
    <span>desktop</span>
</template>

<script>

    export default {
       data(){
            return{                    
                    options: {
                        duration: 200,
                        easing: 'ease-out',
                        perPage: 1,
                        startIndex: 0,
                        draggable: true,
                        multipleDrag: true,
                        threshold: 20,
                        loop: false,
                        rtl: false
                    },

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

    methods: {
    }
}
</script>
